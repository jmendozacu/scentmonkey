<?php
namespace Magento\Checkout\Api\Data;

/**
 * Extension class for @see \Magento\Checkout\Api\Data\PaymentDetailsInterface
 */
class PaymentDetailsExtension extends \Magento\Framework\Api\AbstractSimpleObject implements PaymentDetailsExtensionInterface
{
    /**
     * @return \Magento\Quote\Api\Data\AddressInterface|null
     */
    public function getValidAddress()
    {
        return $this->_get('valid_address');
    }

    /**
     * @param \Magento\Quote\Api\Data\AddressInterface $validAddress
     * @return $this
     */
    public function setValidAddress(\Magento\Quote\Api\Data\AddressInterface $validAddress)
    {
        $this->setData('valid_address', $validAddress);
        return $this;
    }

    /**
     * @return \Magento\Quote\Api\Data\AddressInterface|null
     */
    public function getOriginalAddress()
    {
        return $this->_get('original_address');
    }

    /**
     * @param \Magento\Quote\Api\Data\AddressInterface $originalAddress
     * @return $this
     */
    public function setOriginalAddress(\Magento\Quote\Api\Data\AddressInterface $originalAddress)
    {
        $this->setData('original_address', $originalAddress);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->_get('error_message');
    }

    /**
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage($errorMessage)
    {
        $this->setData('error_message', $errorMessage);
        return $this;
    }
}
