<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Crossborder\Classes\NewAction;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Crossborder\Classes\NewAction
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Crossborder\Classes\NewAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory)
    {
        $this->___init();
        parent::__construct($context, $resultForwardFactory);
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
