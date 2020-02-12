<?php
namespace TNW\AuthorizeCim\Controller\Jwt\Encode;

/**
 * Interceptor class for @see \TNW\AuthorizeCim\Controller\Jwt\Encode
 */
class Interceptor extends \TNW\AuthorizeCim\Controller\Jwt\Encode implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \TNW\AuthorizeCim\Gateway\Config\Config $config, \Magento\Framework\Math\Random $mathRandom, \Magento\Framework\Stdlib\DateTime\DateTime $dataTime)
    {
        $this->___init();
        parent::__construct($context, $config, $mathRandom, $dataTime);
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
