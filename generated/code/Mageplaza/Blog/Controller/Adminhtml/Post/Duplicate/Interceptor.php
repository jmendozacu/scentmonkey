<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Post\Duplicate;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Post\Duplicate
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Post\Duplicate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $registry, \Mageplaza\Blog\Model\PostFactory $postFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory)
    {
        $this->___init();
        parent::__construct($context, $registry, $postFactory, $resultForwardFactory);
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
