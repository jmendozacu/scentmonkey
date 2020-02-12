<?php
namespace Magento\Sales\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Sales\Api\Data\OrderItemInterface
 */
interface OrderItemExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage();

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage);

    /**
     * @return string|null
     */
    public function getHsCode();

    /**
     * @param string $hsCode
     * @return $this
     */
    public function setHsCode($hsCode);

    /**
     * @return string|null
     */
    public function getUnitName();

    /**
     * @param string $unitName
     * @return $this
     */
    public function setUnitName($unitName);

    /**
     * @return float|null
     */
    public function getUnitAmount();

    /**
     * @param float $unitAmount
     * @return $this
     */
    public function setUnitAmount($unitAmount);

    /**
     * @return string|null
     */
    public function getPrefProgramIndicator();

    /**
     * @param string $prefProgramIndicator
     * @return $this
     */
    public function setPrefProgramIndicator($prefProgramIndicator);

    /**
     * @return string[]|null
     */
    public function getVertexTaxCodes();

    /**
     * @param string[] $vertexTaxCodes
     * @return $this
     */
    public function setVertexTaxCodes($vertexTaxCodes);

    /**
     * @return string[]|null
     */
    public function getInvoiceTextCodes();

    /**
     * @param string[] $invoiceTextCodes
     * @return $this
     */
    public function setInvoiceTextCodes($invoiceTextCodes);

    /**
     * @return string[]|null
     */
    public function getTaxCodes();

    /**
     * @param string[] $taxCodes
     * @return $this
     */
    public function setTaxCodes($taxCodes);
}
