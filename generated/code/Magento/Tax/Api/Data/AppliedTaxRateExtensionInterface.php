<?php
namespace Magento\Tax\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Tax\Api\Data\AppliedTaxRateInterface
 */
interface AppliedTaxRateExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return float|null
     */
    public function getRatePercent();

    /**
     * @param float $ratePercent
     * @return $this
     */
    public function setRatePercent($ratePercent);

    /**
     * @return string|null
     */
    public function getTaxName();

    /**
     * @param string $taxName
     * @return $this
     */
    public function setTaxName($taxName);

    /**
     * @return string|null
     */
    public function getJurisCode();

    /**
     * @param string $jurisCode
     * @return $this
     */
    public function setJurisCode($jurisCode);

    /**
     * @return float|null
     */
    public function getTaxable();

    /**
     * @param float $taxable
     * @return $this
     */
    public function setTaxable($taxable);

    /**
     * @return float|null
     */
    public function getTax();

    /**
     * @param float $tax
     * @return $this
     */
    public function setTax($tax);
}
