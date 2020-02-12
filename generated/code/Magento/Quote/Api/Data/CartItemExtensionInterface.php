<?php
namespace Magento\Quote\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Quote\Api\Data\CartItemInterface
 */
interface CartItemExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
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
}
