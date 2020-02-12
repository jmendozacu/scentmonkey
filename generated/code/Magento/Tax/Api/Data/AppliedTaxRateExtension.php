<?php
namespace Magento\Tax\Api\Data;

/**
 * Extension class for @see \Magento\Tax\Api\Data\AppliedTaxRateInterface
 */
class AppliedTaxRateExtension extends \Magento\Framework\Api\AbstractSimpleObject implements AppliedTaxRateExtensionInterface
{
    /**
     * @return float|null
     */
    public function getRatePercent()
    {
        return $this->_get('rate_percent');
    }

    /**
     * @param float $ratePercent
     * @return $this
     */
    public function setRatePercent($ratePercent)
    {
        $this->setData('rate_percent', $ratePercent);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxName()
    {
        return $this->_get('tax_name');
    }

    /**
     * @param string $taxName
     * @return $this
     */
    public function setTaxName($taxName)
    {
        $this->setData('tax_name', $taxName);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getJurisCode()
    {
        return $this->_get('juris_code');
    }

    /**
     * @param string $jurisCode
     * @return $this
     */
    public function setJurisCode($jurisCode)
    {
        $this->setData('juris_code', $jurisCode);
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTaxable()
    {
        return $this->_get('taxable');
    }

    /**
     * @param float $taxable
     * @return $this
     */
    public function setTaxable($taxable)
    {
        $this->setData('taxable', $taxable);
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTax()
    {
        return $this->_get('tax');
    }

    /**
     * @param float $tax
     * @return $this
     */
    public function setTax($tax)
    {
        $this->setData('tax', $tax);
        return $this;
    }
}
