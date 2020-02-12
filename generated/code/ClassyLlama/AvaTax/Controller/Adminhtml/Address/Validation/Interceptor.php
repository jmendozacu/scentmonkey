<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Address\Validation;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Address\Validation
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Address\Validation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\ClassyLlama\AvaTax\Model\ValidAddressManagement $validAddressManagement, \Magento\Customer\Api\Data\AddressInterfaceFactory $customerAddressFactory, \Magento\Framework\Api\DataObjectHelper $dataObjectHelper, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($validAddressManagement, $customerAddressFactory, $dataObjectHelper, $resultJsonFactory, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
