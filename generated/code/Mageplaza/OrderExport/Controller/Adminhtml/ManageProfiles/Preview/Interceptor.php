<?php
namespace Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Preview;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Preview
 */
class Interceptor extends \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Preview implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\OrderExport\Model\ProfileFactory $profileFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Json\Helper\Data $jsonHelper, \Mageplaza\OrderExport\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($profileFactory, $coreRegistry, $context, $fileFactory, $jsonHelper, $helperData);
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
