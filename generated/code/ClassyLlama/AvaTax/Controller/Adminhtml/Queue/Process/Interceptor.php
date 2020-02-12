<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Queue\Process;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Queue\Process
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Queue\Process implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \ClassyLlama\AvaTax\Model\Queue\Task $queueTask, \ClassyLlama\AvaTax\Model\Logger\AvaTaxLogger $avaTaxLogger)
    {
        $this->___init();
        parent::__construct($context, $queueTask, $avaTaxLogger);
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