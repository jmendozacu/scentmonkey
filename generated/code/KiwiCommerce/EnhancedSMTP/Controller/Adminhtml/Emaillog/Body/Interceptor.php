<?php
namespace KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Body;

/**
 * Interceptor class for @see \KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Body
 */
class Interceptor extends \KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Body implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \KiwiCommerce\EnhancedSMTP\Api\LogsRepositoryInterface $log)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $log);
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
