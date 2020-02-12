<?php
namespace Mageplaza\Blog\Controller\Post\DeletePost;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Post\DeletePost
 */
class Interceptor extends \Mageplaza\Blog\Controller\Post\DeletePost implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Mageplaza\Blog\Model\PostFactory $postFactory, \Mageplaza\Blog\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $postFactory, $helperData);
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
