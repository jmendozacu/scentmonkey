<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Tax\Classes\Customer\Delete;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Tax\Classes\Customer\Delete
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Tax\Classes\Customer\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Tax\Api\TaxClassRepositoryInterface $taxClassService, \Magento\Tax\Api\Data\TaxClassInterfaceFactory $taxClassDataObjectFactory)
    {
        $this->___init();
        parent::__construct($context, $taxClassService, $taxClassDataObjectFactory);
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