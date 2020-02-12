<?php
namespace ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation
 */
class Interceptor extends \ClassyLlama\AvaTax\Framework\Interaction\TaxCalculation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Tax\Model\Calculation $calculation, \Magento\Tax\Model\Calculation\CalculatorFactory $calculatorFactory, \Magento\Tax\Model\Config $config, \Magento\Tax\Api\Data\TaxDetailsInterfaceFactory $taxDetailsDataObjectFactory, \Magento\Tax\Api\Data\TaxDetailsItemInterfaceFactory $taxDetailsItemDataObjectFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Tax\Api\TaxClassManagementInterface $taxClassManagement, \Magento\Framework\Api\DataObjectHelper $dataObjectHelper, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Tax\Api\Data\AppliedTaxInterfaceFactory $appliedTaxDataObjectFactory, \Magento\Tax\Api\Data\AppliedTaxRateInterfaceFactory $appliedTaxRateDataObjectFactory, \Magento\Tax\Api\Data\QuoteDetailsItemExtensionFactory $extensionFactory, \Magento\Tax\Api\Data\AppliedTaxRateExtensionFactory $appliedTaxRateExtensionFactory)
    {
        $this->___init();
        parent::__construct($calculation, $calculatorFactory, $config, $taxDetailsDataObjectFactory, $taxDetailsItemDataObjectFactory, $storeManager, $taxClassManagement, $dataObjectHelper, $priceCurrency, $appliedTaxDataObjectFactory, $appliedTaxRateDataObjectFactory, $extensionFactory, $appliedTaxRateExtensionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTax(\Magento\Tax\Api\Data\QuoteDetailsInterface $quoteDetails, $storeId = null, $round = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'calculateTax');
        if (!$pluginInfo) {
            return parent::calculateTax($quoteDetails, $storeId, $round);
        } else {
            return $this->___callPlugins('calculateTax', func_get_args(), $pluginInfo);
        }
    }
}
