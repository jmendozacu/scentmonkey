<?php
namespace Magento\Sales\Api\Data;

/**
 * Extension class for @see \Magento\Sales\Api\Data\InvoiceInterface
 */
class InvoiceExtension extends \Magento\Framework\Api\AbstractSimpleObject implements InvoiceExtensionInterface
{
    /**
     * @return string|null
     */
    public function getAvataxIsUnbalanced()
    {
        return $this->_get('avatax_is_unbalanced');
    }

    /**
     * @param string $avataxIsUnbalanced
     * @return $this
     */
    public function setAvataxIsUnbalanced($avataxIsUnbalanced)
    {
        $this->setData('avatax_is_unbalanced', $avataxIsUnbalanced);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBaseAvataxTaxAmount()
    {
        return $this->_get('base_avatax_tax_amount');
    }

    /**
     * @param string $baseAvataxTaxAmount
     * @return $this
     */
    public function setBaseAvataxTaxAmount($baseAvataxTaxAmount)
    {
        $this->setData('base_avatax_tax_amount', $baseAvataxTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvataxResponse()
    {
        return $this->_get('avatax_response');
    }

    /**
     * @param string $avataxResponse
     * @return $this
     */
    public function setAvataxResponse($avataxResponse)
    {
        $this->setData('avatax_response', $avataxResponse);
        return $this;
    }

    /**
     * @return \Magento\Sales\Api\Data\OrderAddressInterface|null
     */
    public function getVertexTaxCalculationShippingAddress()
    {
        return $this->_get('vertex_tax_calculation_shipping_address');
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderAddressInterface $vertexTaxCalculationShippingAddress
     * @return $this
     */
    public function setVertexTaxCalculationShippingAddress(\Magento\Sales\Api\Data\OrderAddressInterface $vertexTaxCalculationShippingAddress)
    {
        $this->setData('vertex_tax_calculation_shipping_address', $vertexTaxCalculationShippingAddress);
        return $this;
    }

    /**
     * @return \Magento\Sales\Api\Data\OrderAddressInterface|null
     */
    public function getVertexTaxCalculationBillingAddress()
    {
        return $this->_get('vertex_tax_calculation_billing_address');
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderAddressInterface $vertexTaxCalculationBillingAddress
     * @return $this
     */
    public function setVertexTaxCalculationBillingAddress(\Magento\Sales\Api\Data\OrderAddressInterface $vertexTaxCalculationBillingAddress)
    {
        $this->setData('vertex_tax_calculation_billing_address', $vertexTaxCalculationBillingAddress);
        return $this;
    }

    /**
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    public function getVertexTaxCalculationOrder()
    {
        return $this->_get('vertex_tax_calculation_order');
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $vertexTaxCalculationOrder
     * @return $this
     */
    public function setVertexTaxCalculationOrder(\Magento\Sales\Api\Data\OrderInterface $vertexTaxCalculationOrder)
    {
        $this->setData('vertex_tax_calculation_order', $vertexTaxCalculationOrder);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBasePrice()
    {
        return $this->_get('gw_base_price');
    }

    /**
     * @param string $gwBasePrice
     * @return $this
     */
    public function setGwBasePrice($gwBasePrice)
    {
        $this->setData('gw_base_price', $gwBasePrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwPrice()
    {
        return $this->_get('gw_price');
    }

    /**
     * @param string $gwPrice
     * @return $this
     */
    public function setGwPrice($gwPrice)
    {
        $this->setData('gw_price', $gwPrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwItemsBasePrice()
    {
        return $this->_get('gw_items_base_price');
    }

    /**
     * @param string $gwItemsBasePrice
     * @return $this
     */
    public function setGwItemsBasePrice($gwItemsBasePrice)
    {
        $this->setData('gw_items_base_price', $gwItemsBasePrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwItemsPrice()
    {
        return $this->_get('gw_items_price');
    }

    /**
     * @param string $gwItemsPrice
     * @return $this
     */
    public function setGwItemsPrice($gwItemsPrice)
    {
        $this->setData('gw_items_price', $gwItemsPrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwCardBasePrice()
    {
        return $this->_get('gw_card_base_price');
    }

    /**
     * @param string $gwCardBasePrice
     * @return $this
     */
    public function setGwCardBasePrice($gwCardBasePrice)
    {
        $this->setData('gw_card_base_price', $gwCardBasePrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwCardPrice()
    {
        return $this->_get('gw_card_price');
    }

    /**
     * @param string $gwCardPrice
     * @return $this
     */
    public function setGwCardPrice($gwCardPrice)
    {
        $this->setData('gw_card_price', $gwCardPrice);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwBaseTaxAmount()
    {
        return $this->_get('gw_base_tax_amount');
    }

    /**
     * @param string $gwBaseTaxAmount
     * @return $this
     */
    public function setGwBaseTaxAmount($gwBaseTaxAmount)
    {
        $this->setData('gw_base_tax_amount', $gwBaseTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwTaxAmount()
    {
        return $this->_get('gw_tax_amount');
    }

    /**
     * @param string $gwTaxAmount
     * @return $this
     */
    public function setGwTaxAmount($gwTaxAmount)
    {
        $this->setData('gw_tax_amount', $gwTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwItemsBaseTaxAmount()
    {
        return $this->_get('gw_items_base_tax_amount');
    }

    /**
     * @param string $gwItemsBaseTaxAmount
     * @return $this
     */
    public function setGwItemsBaseTaxAmount($gwItemsBaseTaxAmount)
    {
        $this->setData('gw_items_base_tax_amount', $gwItemsBaseTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwItemsTaxAmount()
    {
        return $this->_get('gw_items_tax_amount');
    }

    /**
     * @param string $gwItemsTaxAmount
     * @return $this
     */
    public function setGwItemsTaxAmount($gwItemsTaxAmount)
    {
        $this->setData('gw_items_tax_amount', $gwItemsTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwCardBaseTaxAmount()
    {
        return $this->_get('gw_card_base_tax_amount');
    }

    /**
     * @param string $gwCardBaseTaxAmount
     * @return $this
     */
    public function setGwCardBaseTaxAmount($gwCardBaseTaxAmount)
    {
        $this->setData('gw_card_base_tax_amount', $gwCardBaseTaxAmount);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGwCardTaxAmount()
    {
        return $this->_get('gw_card_tax_amount');
    }

    /**
     * @param string $gwCardTaxAmount
     * @return $this
     */
    public function setGwCardTaxAmount($gwCardTaxAmount)
    {
        $this->setData('gw_card_tax_amount', $gwCardTaxAmount);
        return $this;
    }
}