<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Author\Delete;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Author\Delete
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Author\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Mageplaza\Blog\Model\AuthorFactory $authorFactory, \Mageplaza\Blog\Model\PostFactory $postFactory)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $authorFactory, $postFactory);
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
