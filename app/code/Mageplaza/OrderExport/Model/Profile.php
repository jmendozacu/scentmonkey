<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_OrderExport
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\OrderExport\Model;

use Magento\CatalogRule\Model\Rule\Condition\Combine;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Rule\Model\AbstractModel;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory as CreditmemoCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory as InvoiceCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory as ShipmentCollectionFactory;

/**
 * Class Profile
 * @package Mageplaza\OrderExport\Model
 */
class Profile extends AbstractModel
{
    const TYPE_ORDER      = 'order';
    const TYPE_INVOICE    = 'invoice';
    const TYPE_SHIPMENT   = 'shipment';
    const TYPE_CREDITMEMO = 'creditmemo';
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'mageplaza_orderexport_profile';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'mageplaza_orderexport_profile';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'mageplaza_orderexport_profile';

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var InvoiceCollectionFactory
     */
    protected $invoiceCollectionFactory;

    /**
     * @var ShipmentCollectionFactory
     */
    protected $shipmentCollectionFactory;

    /**
     * @var CreditmemoCollectionFactory
     */
    protected $creditmemoCollectionFactory;

    /**
     * @var array
     */
    protected $productCollection = [];

    /**
     * @var
     */
    protected $itemIds;

    /**
     * Profile constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param TimezoneInterface $localeDate
     * @param OrderFactory $orderFactory
     * @param InvoiceCollectionFactory $invoiceCollectionFactory
     * @param ShipmentCollectionFactory $shipmentCollectionFactory
     * @param CreditmemoCollectionFactory $creditmemoCollectionFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        TimezoneInterface $localeDate,
        OrderFactory $orderFactory,
        InvoiceCollectionFactory $invoiceCollectionFactory,
        ShipmentCollectionFactory $shipmentCollectionFactory,
        CreditmemoCollectionFactory $creditmemoCollectionFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->orderFactory                = $orderFactory;
        $this->invoiceCollectionFactory    = $invoiceCollectionFactory;
        $this->shipmentCollectionFactory   = $shipmentCollectionFactory;
        $this->creditmemoCollectionFactory = $creditmemoCollectionFactory;

        parent::__construct($context, $registry, $formFactory, $localeDate, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mageplaza\OrderExport\Model\ResourceModel\Profile');
    }

    /**
     * @return \Magento\CatalogRule\Model\Rule\Condition\Combine|\Magento\Rule\Model\Action\Collection|\Magento\Rule\Model\Condition\Combine
     */
    public function getConditionsInstance()
    {
        return $this->getActionsInstance();
    }

    /**
     * @return \Magento\CatalogRule\Model\Rule\Condition\Combine|\Magento\Rule\Model\Action\Collection
     */
    public function getActionsInstance()
    {
        return ObjectManager::getInstance()->create(Combine::class);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getMatchingItemIds()
    {
        if (!$this->itemIds) {
            $status            = $this->getStatusCondition();
            $customerGroups    = $this->getCustomerGroups();
            $storeIds          = $this->getStoreIds();
            $createFrom        = $this->getCreateFrom();
            $createTo          = $this->getCreateTo();
            $orderIdFrom       = $this->getOrderIdFrom();
            $orderIdTo         = $this->getOrderIdTo();
            $itemIdFrom        = $this->getItemIdFrom();
            $itemIdTo          = $this->getItemIdTo();
            $exportDuplicate   = $this->getExportDuplicate();
            $exportedIds       = $this->getExportedIds();
            $profileType       = $this->getProfileType();
            $customerGroupsIds = $this->orderFactory->create()->getCollection()
                ->addFieldToFilter('customer_group_id', ['in' => explode(',', $customerGroups)])->getAllIds();

            switch ($profileType) {
                case self::TYPE_INVOICE:
                    $collection = $this->invoiceCollectionFactory->create()->addFieldToSelect('*');
                    if ($status) {
                        $collection->addFieldToFilter('state', ['in' => explode(',', $status)]);
                    }
                    break;
                case self::TYPE_SHIPMENT:
                    $collection = $this->shipmentCollectionFactory->create()->addFieldToSelect('*');
                    if ($status) {
                        $collection->addFieldToFilter('shipment_status', ['in' => explode(',', $status)]);
                    }
                    break;
                case self::TYPE_CREDITMEMO:
                    $collection = $this->creditmemoCollectionFactory->create()->addFieldToSelect('*');
                    if ($status) {
                        $collection->addFieldToFilter('state', ['in' => explode(',', $status)]);
                    }
                    break;
                default:
                    $collection = $this->orderFactory->create()->getCollection();
                    if ($status) {
                        $collection->addFieldToFilter('status', ['in' => explode(',', $status)]);
                    }
            }
            $storeIds = explode(',', $storeIds);
            if (!in_array('0', $storeIds)) {
                $collection->addFieldToFilter('store_id', ['in' => $storeIds]);
            }
            if ($customerGroups) {
                if ($profileType == self::TYPE_ORDER) {
                    $collection->addFieldToFilter('customer_group_id', ['in' => explode(',', $customerGroups)]);
                } else {
                    $collection->addFieldToFilter('order_id', ['in' => $customerGroupsIds]);
                }
            }

            if ($createFrom) {
                $createFrom = (new \DateTime($createFrom))->setTime(0, 0, 0);
                $collection->addFieldToFilter('created_at', ['from' => $createFrom]);
            }
            if ($createTo) {
                $createTo = (new \DateTime($createTo))->setTime(23, 59, 59);
                $collection->addFieldToFilter('created_at', ['to' => $createTo]);
            }
            if (!$exportDuplicate) {
                $collection->addFieldToFilter('entity_id', ['nin' => explode(',', $exportedIds)]);
            }
            if ($profileType != self::TYPE_ORDER) {
                if ($orderIdFrom) {
                    $collection->addFieldToFilter('order_id', ['gteq' => $orderIdFrom]);
                }
                if ($orderIdTo) {
                    $collection->addFieldToFilter('order_id', ['lteq' => $orderIdTo]);
                }
                if ($itemIdFrom) {
                    $collection->addFieldToFilter('entity_id', ['gteq' => $itemIdFrom]);
                }
                if ($itemIdTo) {
                    $collection->addFieldToFilter('entity_id', ['lteq' => $itemIdTo]);
                }
            } else {
                if ($orderIdFrom) {
                    $collection->addFieldToFilter('entity_id', ['gteq' => $orderIdFrom]);
                }
                if ($orderIdTo) {
                    $collection->addFieldToFilter('entity_id', ['lteq' => $orderIdTo]);
                }
            }
            $this->itemIds = $collection->getAllIds();
        }

        return $this->itemIds;
    }
}
