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
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\Registry;
use Mageplaza\OrderExport\Controller\Adminhtml\AbstractManageProfiles;
use Mageplaza\OrderExport\Helper\Data;
use Mageplaza\OrderExport\Model\Config\Source\Events;
use Mageplaza\OrderExport\Model\HistoryFactory;
use Mageplaza\OrderExport\Model\ProfileFactory;

/**
 * Class Save
 * @package Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles
 */
class Save extends AbstractManageProfiles
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var JsonHelper
     */
    protected $jsonHelper;

    /**
     * @var HistoryFactory
     */
    protected $historyFactory;

    /**
     * Save constructor.
     *
     * @param ProfileFactory $profileFactory
     * @param Registry $coreRegistry
     * @param Context $context
     * @param HistoryFactory $historyFactory
     * @param JsonHelper $jsonHelper
     * @param Data $helperData
     */
    public function __construct(
        ProfileFactory $profileFactory,
        Registry $coreRegistry,
        Context $context,
        HistoryFactory $historyFactory,
        JsonHelper $jsonHelper,
        Data $helperData
    )
    {
        $this->historyFactory = $historyFactory;
        $this->jsonHelper     = $jsonHelper;
        $this->helperData     = $helperData;

        parent::__construct($profileFactory, $coreRegistry, $context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data           = $this->getRequest()->getPost('profile');

        if (isset($data['fields_list']) && $data['fields_list']) {
            $data['fields_list'] = $this->jsonHelper->jsonEncode($data['fields_list']);
        }

        $profile = $this->initProfile();
        $profile->addData($data);

        try {
            $profile->save();
            $this->messageManager->addSuccess(__('The profile has been saved.'));
            $this->_getSession()->setData('mageplaza_orderexport_profile_data', false);
            $type = $this->getRequest()->getParam('type');
            if ($type == 'save_generate') {
                try {
                    $this->helperData->generateProfile($profile);
                    $stt    = 1;
                    $logMsg = '';
                    $this->messageManager->addSuccessMessage(__('The profile has been generated successfully'));
                } catch (\Exception $e) {
                    $stt    = 0;
                    $logMsg = __('Something went wrong while generating the profile. %1', $e->getMessage());
                    $this->messageManager->addErrorMessage($logMsg);
                }
                $this->historyFactory->create()->addData([
                    'profile_id'      => $profile->getId(),
                    'name'            => $profile->getName(),
                    'generate_status' => $stt ? 'Success' : 'Error',
                    'type'            => 'Manual',
                    'file'            => $stt ? $profile->getLastGeneratedFile() : '',
                    'product_count'   => $stt ? $profile->getLastGeneratedProductCount() : 0,
                    'message'         => $logMsg
                ])->save();
            } else if ($type == 'save_generate_delivery') {
                $history = $this->historyFactory->create();
                try {
                    $this->helperData->generateProfile($profile);
                    $generate = Events::GENERATE_SUCCESS;
                    $logMsg   = '';
                    $this->messageManager->addSuccessMessage(__('The profile has been generated successfully'));
                } catch (\Exception $e) {
                    $logMsg = __('Something went wrong while generating the profile. %1', $e->getMessage());
                    $this->messageManager->addErrorMessage($logMsg);
                    $generate = Events::GENERATE_ERROR;
                }
                $generateStt = $generate === Events::GENERATE_SUCCESS;

                $history->setData([
                    'profile_id'      => $profile->getId(),
                    'name'            => $profile->getName(),
                    'generate_status' => $generateStt ? 'Success' : 'Error',
                    'type'            => 'Manual',
                    'file'            => $generateStt ? $profile->getLastGeneratedFile() : '',
                    'product_count'   => $generateStt ? $profile->getLastGeneratedProductCount() : 0,
                    'message'         => $logMsg
                ])->save();
                $delivery = Events::DELIVERY_DISABLE;
                if ($generate === Events::GENERATE_SUCCESS) {
                    $deliveryResult = $this->processDeliveryTab($profile, $history);
                    if (is_null($deliveryResult)) {
                        $delivery = Events::DELIVERY_DISABLE;
                    } else if ($deliveryResult) {
                        $delivery = Events::DELIVERY_SUCCESS;
                    } else {
                        $delivery = Events::DELIVERY_ERROR;
                    }
                }
                $history->save();
                $this->helperData->sendAlertMail($profile, $generate, $delivery);
            }

            if ($this->getRequest()->getParam('back')) {
                $resultRedirect->setPath('mporderexport/*/edit', ['id' => $profile->getId(), '_current' => true]);
            } else {
                $resultRedirect->setPath('mporderexport/*/');
            }

            return $resultRedirect;
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the Profile.'));
        }

        $this->_getSession()->setData('mageplaza_orderexport_profile_data', $data);

        $resultRedirect->setPath('mporderexport/*/edit', ['id' => $profile->getId(), '_current' => true]);

        return $resultRedirect;
    }

    /**
     * @param $profile
     * @param $history
     *
     * @return bool|null
     */
    protected function processDeliveryTab($profile, $history)
    {
        $success     = null;
        $deliveryMsg = null;
        $logMsg      = '';

        try {
            if ($profile->getUploadEnable()) {
                $this->helperData->deliveryProfile($profile);
                $success = true;
            }
            if ($profile->getEmailEnable()) {
                $this->helperData->sendExportedFileViaMail($profile);
                $success = true;
            }
            if ($profile->getHttpEnable()) {
                $result = $this->helperData->sendHttpRequest($profile);
                if ($result["success"]) {
                    $success = true;
                } else {
                    $success     = false;
                    $deliveryMsg = $result['message'];
                    $logMsg      = __('Something went wrong while sending http request in profile %1. %2', $profile->getName(), $deliveryMsg);
                }
            }
        } catch (\Exception $e) {
            $success     = false;
            $deliveryMsg = $e->getMessage();
            $logMsg      = __('Something went wrong while processing profile %1. %2', $profile->getName(), $deliveryMsg);
            $this->messageManager->addErrorMessage($logMsg);
        }
        if (!is_null($success)) {
            $deliveryStatus = $success ? "Success" : "Error";
            $history->setDeliveryStatus($deliveryStatus)->setMessage($deliveryMsg);
            $success
                ? $this->messageManager->addSuccessMessage(__('Profile %1 has been delivered successfully', $profile->getName()))
                : $this->messageManager->addErrorMessage($logMsg);
        }

        return $success;
    }
}
