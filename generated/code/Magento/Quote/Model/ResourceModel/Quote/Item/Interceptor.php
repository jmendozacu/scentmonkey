<?php
namespace Magento\Quote\Model\ResourceModel\Quote\Item;

/**
 * Interceptor class for @see \Magento\Quote\Model\ResourceModel\Quote\Item
 */
class Interceptor extends \Magento\Quote\Model\ResourceModel\Quote\Item implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot, \Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationComposite $entityRelationComposite, $connectionName = null)
    {
        $this->___init();
        parent::__construct($context, $entitySnapshot, $entityRelationComposite, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        if (!$pluginInfo) {
            return parent::save($object);
        } else {
            return $this->___callPlugins('save', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        if (!$pluginInfo) {
            return parent::load($object, $value, $field);
        } else {
            return $this->___callPlugins('load', func_get_args(), $pluginInfo);
        }
    }
}
