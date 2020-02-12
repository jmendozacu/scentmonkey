<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_OrderExport
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\OrderExport\Mail\Template;

use Magento\Framework\App\State;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\Template\FactoryInterface;
use Magento\Framework\Mail\Template\SenderResolverInterface;
use Magento\Framework\Mail\Template\TransportBuilder as DefaultBuilder;
use Magento\Framework\Mail\TransportInterfaceFactory;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class TransportBuilder
 * @package Mageplaza\OrderExport\Mail\Template
 */
class TransportBuilder extends DefaultBuilder
{
    /**
     * Attachment name
     */
    const ATTACHMENT_NAME = 'orderexport.xml';

    /**
     * @var State
     */
    protected $state;

    /**
     * TransportBuilder constructor.
     *
     * @param FactoryInterface $templateFactory
     * @param MessageInterface $message
     * @param SenderResolverInterface $senderResolver
     * @param ObjectManagerInterface $objectManager
     * @param TransportInterfaceFactory $mailTransportFactory
     * @param State $state
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct(
        FactoryInterface $templateFactory,
        MessageInterface $message,
        SenderResolverInterface $senderResolver,
        ObjectManagerInterface $objectManager,
        TransportInterfaceFactory $mailTransportFactory,
        State $state
    )
    {
        $this->state = $state;
        try {
            $this->state->getAreaCode();
        } catch (\Exception $e) {
            $this->state->setAreaCode('adminhtml');
        }

        parent::__construct($templateFactory, $message, $senderResolver, $objectManager, $mailTransportFactory);
    }

    /**
     * @param        $attachFile
     * @param string $filename
     * @param string $mimeType
     * @param string $disposition
     * @param string $encoding
     *
     * @return $this
     */
    public function addAttachment(
        $attachFile,
        $filename = self::ATTACHMENT_NAME,
        $mimeType = \Zend_Mime::TYPE_TEXT,
        $disposition = \Zend_Mime::DISPOSITION_ATTACHMENT,
        $encoding = \Zend_Mime::ENCODING_BASE64
    )
    {
        $this->message->createAttachment($attachFile, $mimeType, $disposition, $encoding, $filename);

        return $this;
    }
}
