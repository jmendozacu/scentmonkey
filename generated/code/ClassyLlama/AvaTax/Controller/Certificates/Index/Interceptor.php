<?php
namespace ClassyLlama\AvaTax\Controller\Certificates\Index;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Certificates\Index
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Certificates\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Registry $coreRegistry, \Magento\Customer\Model\Session $session, \Magento\Framework\UrlFactory $urlFactory, \ClassyLlama\AvaTax\Helper\DocumentManagementConfig $documentManagementConfig)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $customerSession, $coreRegistry, $session, $urlFactory, $documentManagementConfig);
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
