<?php
namespace KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Mail;

/**
 * Interceptor class for @see \KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Mail
 */
class Interceptor extends \KiwiCommerce\EnhancedSMTP\Controller\Adminhtml\Emaillog\Mail implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Json\Helper\Data $jsonHelper, \KiwiCommerce\EnhancedSMTP\Helper\Config $config, \Magento\Framework\Mail\Template\SenderResolverInterface $senderResolver, \KiwiCommerce\EnhancedSMTP\Model\SendEmail $sendEmailModel)
    {
        $this->___init();
        parent::__construct($context, $jsonHelper, $config, $senderResolver, $sendEmailModel);
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
