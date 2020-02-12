<?php
namespace ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation;

/**
 * Proxy class for @see \ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation
 */
class Proxy extends \ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\ClassyLlama\\AvaTax\\Framework\\Interaction\\TaxCalculation', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTaxDetails(\Magento\Tax\Api\Data\QuoteDetailsInterface $taxQuoteDetails, $getTaxResult, $useBaseCurrency, $scope)
    {
        return $this->_getSubject()->calculateTaxDetails($taxQuoteDetails, $getTaxResult, $useBaseCurrency, $scope);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildrenItems($items)
    {
        return $this->_getSubject()->getChildrenItems($items);
    }

    /**
     * {@inheritdoc}
     */
    public function getKeyedItems($items)
    {
        return $this->_getSubject()->getKeyedItems($items);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTotalQuantities($items)
    {
        return $this->_getSubject()->calculateTotalQuantities($items);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTotalQuantity(\Magento\Tax\Api\Data\QuoteDetailsItemInterface $item, array $keyedItems)
    {
        return $this->_getSubject()->calculateTotalQuantity($item, $keyedItems);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTax(\Magento\Tax\Api\Data\QuoteDetailsInterface $quoteDetails, $storeId = null, $round = true)
    {
        return $this->_getSubject()->calculateTax($quoteDetails, $storeId, $round);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultCalculatedRate($productTaxClassID, $customerId = null, $storeId = null)
    {
        return $this->_getSubject()->getDefaultCalculatedRate($productTaxClassID, $customerId, $storeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getCalculatedRate($productTaxClassID, $customerId = null, $storeId = null)
    {
        return $this->_getSubject()->getCalculatedRate($productTaxClassID, $customerId, $storeId);
    }
}
