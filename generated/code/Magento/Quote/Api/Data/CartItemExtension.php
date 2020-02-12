<?php
namespace Magento\Quote\Api\Data;

/**
 * Extension class for @see \Magento\Quote\Api\Data\CartItemInterface
 */
class CartItemExtension extends \Magento\Framework\Api\AbstractSimpleObject implements CartItemExtensionInterface
{
    /**
     * @return string|null
     */
    public function getHsCode()
    {
        return $this->_get('hs_code');
    }

    /**
     * @param string $hsCode
     * @return $this
     */
    public function setHsCode($hsCode)
    {
        $this->setData('hs_code', $hsCode);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnitName()
    {
        return $this->_get('unit_name');
    }

    /**
     * @param string $unitName
     * @return $this
     */
    public function setUnitName($unitName)
    {
        $this->setData('unit_name', $unitName);
        return $this;
    }

    /**
     * @return float|null
     */
    public function getUnitAmount()
    {
        return $this->_get('unit_amount');
    }

    /**
     * @param float $unitAmount
     * @return $this
     */
    public function setUnitAmount($unitAmount)
    {
        $this->setData('unit_amount', $unitAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrefProgramIndicator()
    {
        return $this->_get('pref_program_indicator');
    }

    /**
     * @param string $prefProgramIndicator
     * @return $this
     */
    public function setPrefProgramIndicator($prefProgramIndicator)
    {
        $this->setData('pref_program_indicator', $prefProgramIndicator);
        return $this;
    }
}
