<?php
/**
 * ClassyLlama_AvaTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright  Copyright (c) 2018 Avalara, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace ClassyLlama\AvaTax\Observer\Model\Customer;

use ClassyLlama\AvaTax\Exception\AvaTaxCustomerDoesNotExistException;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AfterSaveObserver implements ObserverInterface
{
    /**
     * @var \ClassyLlama\AvaTax\Api\RestCustomerInterface
     */
    protected $restCustomerInterface;

    /**
     * @var \ClassyLlama\AvaTax\Helper\DocumentManagementConfig
     */
    protected $documentManagementConfig;

    /**
     * @var \Magento\Framework\App\State
     */
    protected $appState;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \ClassyLlama\AvaTax\Model\Logger\AvaTaxLogger
     */
    protected $avaTaxLogger;

    /**
     * BeforeSaveObserver constructor.
     *
     * @param \ClassyLlama\AvaTax\Api\RestCustomerInterface       $restCustomerInterface
     * @param \ClassyLlama\AvaTax\Helper\DocumentManagementConfig $documentManagementConfig
     * @param \Magento\Framework\App\State                        $appState
     * @param \Magento\Framework\Message\ManagerInterface         $messageManager
     * @param \ClassyLlama\AvaTax\Model\Logger\AvaTaxLogger       $avaTaxLogger
     */
    public function __construct(
        \ClassyLlama\AvaTax\Api\RestCustomerInterface $restCustomerInterface,
        \ClassyLlama\AvaTax\Helper\DocumentManagementConfig $documentManagementConfig,
        \Magento\Framework\App\State $appState,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \ClassyLlama\AvaTax\Model\Logger\AvaTaxLogger $avaTaxLogger
    )
    {
        $this->restCustomerInterface = $restCustomerInterface;
        $this->documentManagementConfig = $documentManagementConfig;
        $this->appState = $appState;
        $this->messageManager = $messageManager;
        $this->avaTaxLogger = $avaTaxLogger;
    }

    /**
     * {@inheritDoc}
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Customer\Api\Data\CustomerInterface $customer */
        $customer = $observer->getData('customer_data_object');

        if (!$this->documentManagementConfig->isEnabled($customer->getStoreId())) {
            return;
        }

        try {
            $this->restCustomerInterface->updateCustomer($customer, null, $customer->getStoreId());
        } catch (AvaTaxCustomerDoesNotExistException $avaTaxCustomerDoesNotExistException) {
            // Ignore errors where the customer doesn't exist
        } catch (\Exception $exception) {
            if ($this->appState->getAreaCode() == \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE) {
                //show error message
                $this->messageManager->addErrorMessage(__("Error sending updated customer data to Avalara."));
            }

            $this->avaTaxLogger->error(
                __("Error sending updated customer data to Avalara for customer %1.", $customer->getId()),
                ['error message' => $exception->getMessage()]
            );
        }

    }
}
