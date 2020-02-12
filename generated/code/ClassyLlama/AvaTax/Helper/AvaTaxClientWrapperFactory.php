<?php
namespace ClassyLlama\AvaTax\Helper;

/**
 * Factory class for @see \ClassyLlama\AvaTax\Helper\AvaTaxClientWrapper
 */
class AvaTaxClientWrapperFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\ClassyLlama\\AvaTax\\Helper\\AvaTaxClientWrapper')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \ClassyLlama\AvaTax\Helper\AvaTaxClientWrapper
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
