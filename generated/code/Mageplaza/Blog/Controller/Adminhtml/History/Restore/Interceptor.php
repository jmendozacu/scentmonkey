<?php
namespace Mageplaza\Blog\Controller\Adminhtml\History\Restore;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\History\Restore
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\History\Restore implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\Blog\Model\PostHistoryFactory $postHistoryFactory, \Mageplaza\Blog\Model\PostFactory $postFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\Stdlib\DateTime\DateTime $date, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($postHistoryFactory, $postFactory, $coreRegistry, $date, $context);
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
