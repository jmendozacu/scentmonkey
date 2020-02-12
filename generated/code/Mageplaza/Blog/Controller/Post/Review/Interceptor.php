<?php
namespace Mageplaza\Blog\Controller\Post\Review;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Post\Review
 */
class Interceptor extends \Mageplaza\Blog\Controller\Post\Review implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Mageplaza\Blog\Model\PostFactory $postFactory, \Mageplaza\Blog\Model\ResourceModel\PostLike\Collection $postLikeCollection, \Mageplaza\Blog\Model\PostLikeFactory $postLikeFactory, \Mageplaza\Blog\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $postFactory, $postLikeCollection, $postLikeFactory, $helperData);
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
