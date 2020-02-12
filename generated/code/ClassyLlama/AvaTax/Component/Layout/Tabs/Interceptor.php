<?php
namespace ClassyLlama\AvaTax\Component\Layout\Tabs;

/**
 * Interceptor class for @see \ClassyLlama\AvaTax\Component\Layout\Tabs
 */
class Interceptor extends \ClassyLlama\AvaTax\Component\Layout\Tabs implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, $navContainerName = null, $data = [])
    {
        $this->___init();
        parent::__construct($uiComponentFactory, $navContainerName, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function build(\Magento\Framework\View\Element\UiComponentInterface $component)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'build');
        if (!$pluginInfo) {
            return parent::build($component);
        } else {
            return $this->___callPlugins('build', func_get_args(), $pluginInfo);
        }
    }
}
