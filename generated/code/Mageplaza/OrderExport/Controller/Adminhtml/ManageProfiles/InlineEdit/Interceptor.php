<?php
namespace Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\InlineEdit;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\InlineEdit
 */
class Interceptor extends \Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Mageplaza\OrderExport\Model\ProfileFactory $profileFactory)
    {
        $this->___init();
        parent::__construct($context, $jsonFactory, $profileFactory);
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
