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

namespace Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Mageplaza\OrderExport\Controller\Adminhtml\AbstractManageProfiles;
use Mageplaza\OrderExport\Helper\Data;
use Mageplaza\OrderExport\Model\HistoryFactory;
use Mageplaza\OrderExport\Model\ProfileFactory;

/**
 * Class Generate
 * @package Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles
 */
class Generate extends AbstractManageProfiles
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var HistoryFactory
     */
    protected $historyFactory;

    /**
     * Generate constructor.
     *
     * @param ProfileFactory $profileFactory
     * @param Registry $coreRegistry
     * @param Context $context
     * @param HistoryFactory $historyFactory
     * @param Data $helperData
     */
    public function __construct(
        ProfileFactory $profileFactory,
        Registry $coreRegistry,
        Context $context,
        HistoryFactory $historyFactory,
        Data $helperData
    )
    {
        $this->historyFactory = $historyFactory;
        $this->helperData     = $helperData;

        parent::__construct($profileFactory, $coreRegistry, $context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $profile        = $this->initProfile();
        $success        = null;
        $errorMsg       = '';
        try {
            $this->helperData->generateProfile($profile);
            $success = true;
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            $success  = false;
        }
        if ($success) {
            $this->messageManager->addSuccessMessage(__('The profile has been generated successfully'));
        } else {
            $this->messageManager->addErrorMessage(
                __('Something went wrong while generating the profile. %1', $errorMsg)
            );
        }

        $this->historyFactory->create()->addData([
            'profile_id'      => $profile->getId(),
            'name'            => $profile->getName(),
            'generate_status' => $success ? 'Success' : 'Error',
            'type'            => 'Manual',
            'file'            => $success ? $profile->getLastGeneratedFile() : '',
            'product_count'   => $success ? $profile->getLastGeneratedProductCount() : 0,
            'message'         => $errorMsg
        ])->save();

        $resultRedirect->setPath('mporderexport/*/edit', ['id' => $profile->getId(), '_current' => true]);

        return $resultRedirect;
    }
}