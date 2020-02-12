<?php
namespace Mageplaza\Blog\Controller\Post\EditPost;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Post\EditPost
 */
class Interceptor extends \Mageplaza\Blog\Controller\Post\EditPost implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory, \Mageplaza\Blog\Model\ResourceModel\Author\Collection $authorCollection, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Registry $coreRegistry, \Mageplaza\Blog\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $resultForwardFactory, $authorCollection, $customerSession, $coreRegistry, $helperData);
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