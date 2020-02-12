<?php
namespace Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Edit;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Edit
 */
class Interceptor extends \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\OrderExport\Model\ProfileFactory $profileFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->___init();
        parent::__construct($profileFactory, $coreRegistry, $context, $resultPageFactory);
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
