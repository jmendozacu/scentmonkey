<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Author\PostsGrid;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Author\PostsGrid
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Author\PostsGrid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Mageplaza\Blog\Model\AuthorFactory $authorFactory)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $resultLayoutFactory, $authorFactory);
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
