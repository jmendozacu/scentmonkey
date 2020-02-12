<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Certificates\Delete;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Certificates\Delete
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Certificates\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \ClassyLlama\AvaTax\Helper\CertificateDeleteHelper $certificateDeleteHelper)
    {
        $this->___init();
        parent::__construct($context, $certificateDeleteHelper);
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
