<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Address\Region;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Address\Region
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Address\Region implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Directory\Helper\Data $directoryHelper, \Magento\Framework\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, ?\Magento\Framework\Escaper $escaper = null)
    {
        $this->___init();
        parent::__construct($directoryHelper, $context, $resultJsonFactory, $escaper);
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
