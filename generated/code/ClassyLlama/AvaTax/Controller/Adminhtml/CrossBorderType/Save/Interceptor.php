<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\CrossBorderType\Save;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\CrossBorderType\Save
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\CrossBorderType\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \ClassyLlama\AvaTax\Api\CrossBorderTypeRepositoryInterface $crossBorderTypeRepository, \ClassyLlama\AvaTax\Api\Data\CrossBorderTypeInterfaceFactory $crossBorderTypeInterfaceFactory)
    {
        $this->___init();
        parent::__construct($context, $dataPersistor, $crossBorderTypeRepository, $crossBorderTypeInterfaceFactory);
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
