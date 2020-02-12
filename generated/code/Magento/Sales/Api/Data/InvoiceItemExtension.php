<?php
namespace Magento\Sales\Api\Data;

/**
 * Extension class for @see \Magento\Sales\Api\Data\InvoiceItemInterface
 */
class InvoiceItemExtension extends \Magento\Framework\Api\AbstractSimpleObject implements InvoiceItemExtensionInterface
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

    /**
     * @return string[]|null
     */
    public function getVertexTaxCodes()
    {
        return $this->_get('vertex_tax_codes');
    }

    /**
     * @param string[] $vertexTaxCodes
     * @return $this
     */
    public function setVertexTaxCodes($vertexTaxCodes)
    {
        $this->setData('vertex_tax_codes', $vertexTaxCodes);
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getInvoiceTextCodes()
    {
        return $this->_get('invoice_text_codes');
    }

    /**
     * @param string[] $invoiceTextCodes
     * @return $this
     */
    public function setInvoiceTextCodes($invoiceTextCodes)
    {
        $this->setData('invoice_text_codes', $invoiceTextCodes);
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getTaxCodes()
    {
        return $this->_get('tax_codes');
    }

    /**
     * @param string[] $taxCodes
     * @return $this
     */
    public function setTaxCodes($taxCodes)
    {
        $this->setData('tax_codes', $taxCodes);
        return $this;
    }
}
