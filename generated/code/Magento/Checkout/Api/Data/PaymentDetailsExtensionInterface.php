<?php
namespace Magento\Checkout\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Checkout\Api\Data\PaymentDetailsInterface
 */
interface PaymentDetailsExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\Quote\Api\Data\AddressInterface|null
     */
    public function getValidAddress();

    /**
     * @param \Magento\Quote\Api\Data\AddressInterface $validAddress
     * @return $this
     */
    public function setValidAddress(\Magento\Quote\Api\Data\AddressInterface $validAddress);

    /**
     * @return \Magento\Quote\Api\Data\AddressInterface|null
     */
    public function getOriginalAddress();

    /**
     * @param \Magento\Quote\Api\Data\AddressInterface $originalAddress
     * @return $this
     */
    public function setOriginalAddress(\Magento\Quote\Api\Data\AddressInterface $originalAddress);

    /**
     * @return string|null
     */
    public function getErrorMessage();

    /**
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage($errorMessage);
}
