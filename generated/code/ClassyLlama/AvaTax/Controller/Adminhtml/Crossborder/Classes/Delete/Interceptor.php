<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Crossborder\Classes\Delete;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Crossborder\Classes\Delete
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Crossborder\Classes\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \ClassyLlama\AvaTax\Api\Data\CrossBorderClassRepositoryInterface $crossBorderClassRepository, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor)
    {
        $this->___init();
        parent::__construct($context, $crossBorderClassRepository, $dataPersistor);
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