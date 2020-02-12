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
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Registry;
use Mageplaza\OrderExport\Controller\Adminhtml\AbstractManageProfiles;
use Mageplaza\OrderExport\Helper\Data;
use Mageplaza\OrderExport\Model\HistoryFactory;
use Mageplaza\OrderExport\Model\ProfileFactory;

/**
 * Class QuickExport
 * @package Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles
 */
class QuickExport extends AbstractManageProfiles
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
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * QuickExport constructor.
     *
     * @param ProfileFactory $profileFactory
     * @param Registry $coreRegistry
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param HistoryFactory $historyFactory
     * @param Data $helperData
     */
    public function __construct(
        ProfileFactory $profileFactory,
        Registry $coreRegistry,
        Context $context,
        FileFactory $fileFactory,
        HistoryFactory $historyFactory,
        Data $helperData
    )
    {
        $this->fileFactory    = $fileFactory;
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
        $selected       = $this->getRequest()->getParam('selected') ?: [];
        $resultRedirect = $this->resultRedirectFactory->create();
        $profile        = $this->initProfile();

        try {
            list($content, $ids) = $this->helperData->generateLiquidTemplate($profile, $selected);
            $this->helperData->createProfileFile('quickexport', $content);
            $this->historyFactory->create()->addData([
                'profile_id'      => $profile->getId(),
                'name'            => $profile->getName(),
                'generate_status' => 'Success',
                'type'            => 'Quick Export',
                'file'            => '',
                'product_count'   => count($ids),
                'message'         => ''
            ])->save();
            $this->messageManager->addSuccessMessage(__('The profile has been generated successfully'));
         
        
            return $this->fileFactory->create(
                'export.' . $this->helperData->getFileType($profile->getFileType()),
                ['type' => 'filename', 'value' => 'mageplaza/order_export/profile/quickexport', 'rm' => false],
                'media'
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('Something went wrong while generating the profile. %1', $e->getMessage())
            );
            $this->historyFactory->create()->addData([
                'profile_id'      => $profile->getId(),
                'name'            => $profile->getName(),
                'generate_status' => 'Error',
                'type'            => 'Quick Export',
                'file'            => '',
                'product_count'   => 0,
                'message'         => ''
            ])->save();
        }
        $resultRedirect->setPath($this->_redirect->getRefererUrl());

        return $resultRedirect;
    }
}
