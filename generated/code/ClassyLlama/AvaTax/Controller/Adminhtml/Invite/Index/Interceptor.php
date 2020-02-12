<?php
namespace ClassyLlama\AvaTax\Controller\Adminhtml\Invite\Index;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Controller\Adminhtml\Invite\Index
 */
class Interceptor extends \ClassyLlama\AvaTax\Controller\Adminhtml\Invite\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\ClassyLlama\AvaTax\Api\RestCustomerInterface $restCustomer, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($restCustomer, $customerRepository, $context);
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
