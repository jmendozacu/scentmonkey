<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\CrossBorderType\Delete;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\CrossBorderType\Delete
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\CrossBorderType\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\ClassyLlama\AvaTax\Api\CrossBorderTypeRepositoryInterface $crossBorderTypeRepository, \Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->___init();
        parent::__construct($crossBorderTypeRepository, $context, $coreRegistry);
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
