<?php
namespace Mageplaza\OrderExport\Controller\Download\Index;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Controller\Download\Index
 */
class Interceptor extends \Mageplaza\OrderExport\Controller\Download\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory, \Mageplaza\OrderExport\Model\ProfileFactory $profileFactory)
    {
        $this->___init();
        parent::__construct($context, $fileFactory, $forwardFactory, $profileFactory);
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
