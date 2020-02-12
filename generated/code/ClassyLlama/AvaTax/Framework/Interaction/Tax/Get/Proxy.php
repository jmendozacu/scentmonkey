<?php
namespace ClassyLlama\AvaTax\Framework\Interaction\Tax\Get;

/**
 * Proxy class for @see \ClassyLlama\AvaTax\Framework\Interaction\Tax\Get
 */
class Proxy extends \ClassyLlama\AvaTax\Framework\Interaction\Tax\Get implements \Magento\Framework\ObjectManager\NoninterceptableInterface
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
     * @var \ClassyLlama\AvaTax\Framework\Interaction\Tax\Get
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\ClassyLlama\\AvaTax\\Framework\\Interaction\\Tax\\Get', $shared = true)
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
     * @return \ClassyLlama\AvaTax\Framework\Interaction\Tax\Get
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
    public function processSalesObject($object)
    {
        return $this->_getSubject()->processSalesObject($object);
    }

    /**
     * {@inheritdoc}
     */
    public function convertTaxResultToArray($taxResult)
    {
        return $this->_getSubject()->convertTaxResultToArray($taxResult);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxDetailsForQuote(\Magento\Quote\Model\Quote $quote, \Magento\Tax\Api\Data\QuoteDetailsInterface $taxQuoteDetails, \Magento\Tax\Api\Data\QuoteDetailsInterface $baseTaxQuoteDetails, \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment)
    {
        return $this->_getSubject()->getTaxDetailsForQuote($quote, $taxQuoteDetails, $baseTaxQuoteDetails, $shippingAssignment);
    }
}
