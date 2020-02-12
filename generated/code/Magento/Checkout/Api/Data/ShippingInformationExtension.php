<?php
namespace Magento\Checkout\Api\Data;

/**
 * Extension class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
class ShippingInformationExtension extends \Magento\Framework\Api\AbstractSimpleObject implements ShippingInformationExtensionInterface
{
    /**
     * @return boolean|null
     */
    public function getShouldValidateAddress()
    {
        return $this->_get('should_validate_address');
    }

    /**
     * @param boolean $shouldValidateAddress
     * @return $this
     */
    public function setShouldValidateAddress($shouldValidateAddress)
    {
        $this->setData('should_validate_address', $shouldValidateAddress);
        return $this;
    }
}
