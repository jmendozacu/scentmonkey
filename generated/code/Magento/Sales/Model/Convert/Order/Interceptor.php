<?php
namespace Magento\Sales\Model\Convert\Order;

/**
 * Interceptor class for @see \Magento\Sales\Model\Convert\Order
 */
class Interceptor extends \Magento\Sales\Model\Convert\Order implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Sales\Api\InvoiceRepositoryInterface $invoiceRepository, \Magento\Sales\Model\Order\Invoice\ItemFactory $invoiceItemFactory, \Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository, \Magento\Sales\Model\Order\Shipment\ItemFactory $shipmentItemFactory, \Magento\Sales\Api\CreditmemoRepositoryInterface $creditmemoRepository, \Magento\Sales\Model\Order\Creditmemo\ItemFactory $creditmemoItemFactory, \Magento\Framework\DataObject\Copy $objectCopyService, array $data = [])
    {
        $this->___init();
        parent::__construct($eventManager, $invoiceRepository, $invoiceItemFactory, $shipmentRepository, $shipmentItemFactory, $creditmemoRepository, $creditmemoItemFactory, $objectCopyService, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function itemToInvoiceItem(\Magento\Sales\Model\Order\Item $item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'itemToInvoiceItem');
        if (!$pluginInfo) {
            return parent::itemToInvoiceItem($item);
        } else {
            return $this->___callPlugins('itemToInvoiceItem', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function itemToCreditmemoItem(\Magento\Sales\Model\Order\Item $item)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'itemToCreditmemoItem');
        if (!$pluginInfo) {
            return parent::itemToCreditmemoItem($item);
        } else {
            return $this->___callPlugins('itemToCreditmemoItem', func_get_args(), $pluginInfo);
        }
    }
}
