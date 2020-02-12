<?php
namespace Xtento\GridActions\Controller\Adminhtml\Pdf\Labels;

/**
 * Interceptor class for @see \Xtento\GridActions\Controller\Adminhtml\Pdf\Labels
 */
class Interceptor extends \Xtento\GridActions\Controller\Adminhtml\Pdf\Labels implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Shipping\Model\Shipping\LabelGenerator $labelGenerator, \Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory $shipmentCollectionFactory, \Magento\Framework\App\Response\Http\FileFactory $fileFactory)
    {
        $this->___init();
        parent::__construct($context, $labelGenerator, $shipmentCollectionFactory, $fileFactory);
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
