<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\CertificatesToken\Get;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\CertificatesToken\Get
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\CertificatesToken\Get implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $resultPageFactory, \ClassyLlama\AvaTax\Model\Token $tokenModel)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $tokenModel);
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
