<?php
namespace ClassyLlama\AvaTax\Controller\Certificates\Download;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Certificates\Download
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Certificates\Download implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\ClassyLlama\AvaTax\Helper\CertificateDownloadControllerHelper $certificateDownloadControllerHelper, \Magento\Backend\App\Action\Context $context, \Magento\Customer\Model\Session $session)
    {
        $this->___init();
        parent::__construct($certificateDownloadControllerHelper, $context, $session);
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
