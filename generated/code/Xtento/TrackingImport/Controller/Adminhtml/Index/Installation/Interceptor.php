<?php
namespace Xtento\TrackingImport\Controller\Adminhtml\Index\Installation;

/**
 * Interceptor class for @see \Xtento\TrackingImport\Controller\Adminhtml\Index\Installation
 */
class Interceptor extends \Xtento\TrackingImport\Controller\Adminhtml\Index\Installation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Xtento\TrackingImport\Helper\Module $moduleHelper, \Xtento\XtCore\Helper\Cron $cronHelper, \Xtento\TrackingImport\Model\ResourceModel\Profile\CollectionFactory $profileCollectionFactory, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->___init();
        parent::__construct($context, $moduleHelper, $cronHelper, $profileCollectionFactory, $scopeConfig);
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