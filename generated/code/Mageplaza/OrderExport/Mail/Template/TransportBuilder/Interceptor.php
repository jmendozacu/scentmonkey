<?php
namespace Mageplaza\OrderExport\Mail\Template\TransportBuilder;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Mail\Template\TransportBuilder
 */
class Interceptor extends \Mageplaza\OrderExport\Mail\Template\TransportBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Mail\Template\FactoryInterface $templateFactory, \Magento\Framework\Mail\MessageInterface $message, \Magento\Framework\Mail\Template\SenderResolverInterface $senderResolver, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Mail\TransportInterfaceFactory $mailTransportFactory, \Magento\Framework\App\State $state)
    {
        $this->___init();
        parent::__construct($templateFactory, $message, $senderResolver, $objectManager, $mailTransportFactory, $state);
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateOptions($templateOptions)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateOptions');
        if (!$pluginInfo) {
            return parent::setTemplateOptions($templateOptions);
        } else {
            return $this->___callPlugins('setTemplateOptions', func_get_args(), $pluginInfo);
        }
    }
}
