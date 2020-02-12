<?php
namespace ClassyLlama\AvaTax\Framework\Interaction\MetaData;

/**
 * Factory class for @see \ClassyLlama\AvaTax\Framework\Interaction\MetaData\DataObjectType
 */
class DataObjectTypeFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\ClassyLlama\\AvaTax\\Framework\\Interaction\\MetaData\\DataObjectType')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \ClassyLlama\AvaTax\Framework\Interaction\MetaData\DataObjectType
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
