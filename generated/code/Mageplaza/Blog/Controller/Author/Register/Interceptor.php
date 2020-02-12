<?php
namespace Mageplaza\Blog\Controller\Author\Register;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Author\Register
 */
class Interceptor extends \Mageplaza\Blog\Controller\Author\Register implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory, \Magento\Customer\Model\Session $customerSession, \Mageplaza\Blog\Helper\Image $imageHelper, \Mageplaza\Blog\Model\AuthorFactory $authorFactory, \Mageplaza\Blog\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $resultForwardFactory, $customerSession, $imageHelper, $authorFactory, $helperData);
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
