<?php
namespace Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Delivery;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Delivery
 */
class Interceptor extends \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Delivery implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\OrderExport\Model\ProfileFactory $profileFactory, \Mageplaza\OrderExport\Model\HistoryFactory $historyFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context, \Mageplaza\OrderExport\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($profileFactory, $historyFactory, $coreRegistry, $context, $helperData);
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
