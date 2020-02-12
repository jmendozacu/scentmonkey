<?php
namespace Magento\Ui\Component\Form;

/**
 * Interceptor class for @see \Magento\Ui\Component\Form
 */
class Interceptor extends \Magento\Ui\Component\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\Api\FilterBuilder $filterBuilder, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $filterBuilder, $components, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildComponents()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getChildComponents');
        if (!$pluginInfo) {
            return parent::getChildComponents();
        } else {
            return $this->___callPlugins('getChildComponents', func_get_args(), $pluginInfo);
        }
    }
}
