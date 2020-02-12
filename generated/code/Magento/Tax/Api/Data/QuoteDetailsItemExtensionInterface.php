<?php
namespace Magento\Tax\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Tax\Api\Data\QuoteDetailsItemInterface
 */
interface QuoteDetailsItemExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return float|null
     */
    public function getPriceForTaxCalculation();

    /**
     * @param float $priceForTaxCalculation
     * @return $this
     */
    public function setPriceForTaxCalculation($priceForTaxCalculation);

    /**
     * @return float|null
     */
    public function getTotalQuantity();

    /**
     * @param float $totalQuantity
     * @return $this
     */
    public function setTotalQuantity($totalQuantity);

    /**
     * @return string|null
     */
    public function getAvataxItemCode();

    /**
     * @param string $avataxItemCode
     * @return $this
     */
    public function setAvataxItemCode($avataxItemCode);

    /**
     * @return string|null
     */
    public function getAvataxTaxCode();

    /**
     * @param string $avataxTaxCode
     * @return $this
     */
    public function setAvataxTaxCode($avataxTaxCode);

    /**
     * @return string|null
     */
    public function getAvataxDescription();

    /**
     * @param string $avataxDescription
     * @return $this
     */
    public function setAvataxDescription($avataxDescription);

    /**
     * @return string|null
     */
    public function getAvataxRef1();

    /**
     * @param string $avataxRef1
     * @return $this
     */
    public function setAvataxRef1($avataxRef1);

    /**
     * @return string|null
     */
    public function getAvataxRef2();

    /**
     * @param string $avataxRef2
     * @return $this
     */
    public function setAvataxRef2($avataxRef2);

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
     * @return string|null
     */
    public function getVertexProductCode();

    /**
     * @param string $vertexProductCode
     * @return $this
     */
    public function setVertexProductCode($vertexProductCode);

    /**
     * @return bool|null
     */
    public function getVertexIsConfigurable();

    /**
     * @param bool $vertexIsConfigurable
     * @return $this
     */
    public function setVertexIsConfigurable($vertexIsConfigurable);

    /**
     * @return string|null
     */
    public function getStoreId();

    /**
     * @param string $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * @return string|null
     */
    public function getQuoteId();

    /**
     * @param string $quoteId
     * @return $this
     */
    public function setQuoteId($quoteId);

    /**
     * @return string|null
     */
    public function getProductId();

    /**
     * @param string $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * @return string|null
     */
    public function getQuoteItemId();

    /**
     * @param string $quoteItemId
     * @return $this
     */
    public function setQuoteItemId($quoteItemId);

    /**
     * @return string|null
     */
    public function getCustomerId();

    /**
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId($customerId);
}
