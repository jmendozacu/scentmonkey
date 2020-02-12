<?php
namespace KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Email;

/**
 * Interceptor class for @see \KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Email
 */
class Interceptor extends \KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Email implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \KiwiCommerce\EnhancedSMTP\Api\LogsRepositoryInterface $logsRepository, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->___init();
        parent::__construct($context, $logsRepository, $resultJsonFactory, $timezone);
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
