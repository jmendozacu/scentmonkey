<?php
namespace Jframeworks\Addressvalidator\Controller\Shipping\Check;

/**
 * Interceptor class for @see \Jframeworks\Addressvalidator\Controller\Shipping\Check
 */
class Interceptor extends \Jframeworks\Addressvalidator\Controller\Shipping\Check implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Jframeworks\Addressvalidator\Helper\Data $helper, \Magento\Directory\Model\Region $countryCollectionFactory)
    {
        $this->___init();
        parent::__construct($context, $helper, $countryCollectionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
