<?php
namespace Mageplaza\Blog\Controller\Adminhtml\History\Save;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\History\Save
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\History\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\Blog\Model\PostHistoryFactory $postHistoryFactory, \Mageplaza\Blog\Model\PostFactory $postFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\Stdlib\DateTime\DateTime $date, \Magento\Backend\Helper\Js $jsHelper, \Mageplaza\Blog\Helper\Image $imageHelper, \Mageplaza\Blog\Helper\Data $helperData, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($postHistoryFactory, $postFactory, $coreRegistry, $date, $jsHelper, $imageHelper, $helperData, $timezone, $context);
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
