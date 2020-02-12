<?php
/**
 * Copyright © 2017 TechNWeb, Inc. All rights reserved.
 * See TNW_LICENSE.txt for license details.
 */
namespace TNW\AuthorizeCim\Gateway\Command;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Payment\Gateway\Command\CommandPoolInterface;
use Magento\Payment\Gateway\CommandInterface;
use Magento\Payment\Gateway\Helper\ContextHelper;
use Magento\Sales\Api\Data\OrderPaymentInterface;
use Magento\Sales\Api\Data\TransactionInterface;
use Magento\Sales\Api\TransactionRepositoryInterface;
use TNW\AuthorizeCim\Gateway\Helper\SubjectReader;

class CaptureStrategyCommand implements CommandInterface
{
    const SALE = 'sale';
    const CAPTURE = 'settlement';
    const CUSTOMER = 'customer';

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var TransactionRepositoryInterface */
    private $transactionRepository;

    /** @var SubjectReader */
    private $subjectReader;

    /** @var CommandPoolInterface */
    private $commandPool;

    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TransactionRepositoryInterface $transactionRepository
     * @param SubjectReader $subjectReader
     * @param CommandPoolInterface $commandPool
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TransactionRepositoryInterface $transactionRepository,
        SubjectReader $subjectReader,
        CommandPoolInterface $commandPool,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->transactionRepository = $transactionRepository;
        $this->subjectReader = $subjectReader;
        $this->commandPool = $commandPool;
        $this->logger = $logger;
    }

    /**
     * @param array $commandSubject
     * @return void
     * @throws \Magento\Framework\Exception\NotFoundException
     * @throws \Magento\Payment\Gateway\Command\CommandException
     */
    public function execute(array $commandSubject)
    {
        $paymentDataObject = $this->subjectReader->readPayment($commandSubject);

        /** @var \Magento\Sales\Model\Order\Payment $paymentInfo */
        $paymentInfo = $paymentDataObject->getPayment();
        ContextHelper::assertOrderPayment($paymentInfo);

        $command = $this->getCommand($paymentInfo);
        $this->commandPool->get($command)->execute($commandSubject);

        if ($paymentInfo->getAdditionalInformation('is_active_payment_token_enabler')) {
            try {
                $this->commandPool->get(self::CUSTOMER)->execute($commandSubject);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }

    /**
     * @param OrderPaymentInterface $payment
     * @return string
     */
    private function getCommand(OrderPaymentInterface $payment)
    {
        $existsCapture = $this->isExistsCaptureTransaction($payment);
        if (!$payment->getAuthorizationTransaction() && !$existsCapture) {
            return self::SALE;
        }

        if (!$existsCapture) {
            return self::CAPTURE;
        }
    }

    /**
     * @param OrderPaymentInterface $payment
     * @return bool
     */
    private function isExistsCaptureTransaction(OrderPaymentInterface $payment)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('payment_id', $payment->getId())
            ->addFilter('txn_type', TransactionInterface::TYPE_CAPTURE)
            ->create();

        return (boolean)$this->transactionRepository
            ->getList($searchCriteria)
            ->getTotalCount();
    }
}
