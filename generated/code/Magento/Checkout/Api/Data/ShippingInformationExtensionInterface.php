<?php
namespace Magento\Checkout\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
interface ShippingInformationExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return boolean|null
     */
    public function getShouldValidateAddress();

    /**
     * @param boolean $shouldValidateAddress
     * @return $this
     */
    public function setShouldValidateAddress($shouldValidateAddress);
}
