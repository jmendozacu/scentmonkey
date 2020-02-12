<?php
namespace Magento\Tax\Api\Data;

/**
 * Extension class for @see \Magento\Tax\Api\Data\QuoteDetailsItemInterface
 */
class QuoteDetailsItemExtension extends \Magento\Framework\Api\AbstractSimpleObject implements QuoteDetailsItemExtensionInterface
{
    /**
     * @return float|null
     */
    public function getPriceForTaxCalculation()
    {
        return $this->_get('price_for_tax_calculation');
    }

    /**
     * @param float $priceForTaxCalculation
     * @return $this
     */
    public function setPriceForTaxCalculation($priceForTaxCalculation)
    {
        $this->setData('price_for_tax_calculation', $priceForTaxCalculation);
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotalQuantity()
    {
        return $this->_get('total_quantity');
    }

    /**
     * @param float $totalQuantity
     * @return $this
     */
    public function setTotalQuantity($totalQuantity)
    {
        $this->setData('total_quantity', $totalQuantity);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvataxItemCode()
    {
        return $this->_get('avatax_item_code');
    }

    /**
     * @param string $avataxItemCode
     * @return $this
     */
    public function setAvataxItemCode($avataxItemCode)
    {
        $this->setData('avatax_item_code', $avataxItemCode);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvataxTaxCode()
    {
        return $this->_get('avatax_tax_code');
    }

    /**
     * @param string $avataxTaxCode
     * @return $this
     */
    public function setAvataxTaxCode($avataxTaxCode)
    {
        $this->setData('avatax_tax_code', $avataxTaxCode);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvataxDescription()
    {
        return $this->_get('avatax_description');
    }

    /**
     * @param string $avataxDescription
     * @return $this
     */
    public function setAvataxDescription($avataxDescription)
    {
        $this->setData('avatax_description', $avataxDescription);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvataxRef1()
    {
        return $this->_get('avatax_ref1');
    }

    /**
     * @param string $avataxRef1
     * @return $this
     */
    public function setAvataxRef1($avataxRef1)
    {
        $this->setData('avatax_ref1', $avataxRef1);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvataxRef2()
    {
        return $this->_get('avatax_ref2');
    }

    /**
     * @param string $avataxRef2
     * @return $this
     */
    public function setAvataxRef2($avataxRef2)
    {
        $this->setData('avatax_ref2', $avataxRef2);
        return $this;
    }

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
     * @return string|null
     */
    public function getVertexProductCode()
    {
        return $this->_get('vertex_product_code');
    }

    /**
     * @param string $vertexProductCode
     * @return $this
     */
    public function setVertexProductCode($vertexProductCode)
    {
        $this->setData('vertex_product_code', $vertexProductCode);
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getVertexIsConfigurable()
    {
        return $this->_get('vertex_is_configurable');
    }

    /**
     * @param bool $vertexIsConfigurable
     * @return $this
     */
    public function setVertexIsConfigurable($vertexIsConfigurable)
    {
        $this->setData('vertex_is_configurable', $vertexIsConfigurable);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStoreId()
    {
        return $this->_get('store_id');
    }

    /**
     * @param string $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->setData('store_id', $storeId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuoteId()
    {
        return $this->_get('quote_id');
    }

    /**
     * @param string $quoteId
     * @return $this
     */
    public function setQuoteId($quoteId)
    {
        $this->setData('quote_id', $quoteId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductId()
    {
        return $this->_get('product_id');
    }

    /**
     * @param string $productId
     * @return $this
     */
    public function setProductId($productId)
    {
        $this->setData('product_id', $productId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuoteItemId()
    {
        return $this->_get('quote_item_id');
    }

    /**
     * @param string $quoteItemId
     * @return $this
     */
    public function setQuoteItemId($quoteItemId)
    {
        $this->setData('quote_item_id', $quoteItemId);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_get('customer_id');
    }

    /**
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->setData('customer_id', $customerId);
        return $this;
    }
}
