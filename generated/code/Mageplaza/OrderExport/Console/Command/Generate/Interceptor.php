<?php
namespace Mageplaza\OrderExport\Console\Command\Generate;

/**
 * Interceptor class for @see \Mageplaza\OrderExport\Console\Command\Generate
 */
class Interceptor extends \Mageplaza\OrderExport\Console\Command\Generate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\State $state, \Mageplaza\OrderExport\Model\ProfileFactory $profileFactory, \Mageplaza\OrderExport\Model\HistoryFactory $historyFactory, \Mageplaza\OrderExport\Helper\Data $helperData, $name = null)
    {
        $this->___init();
        parent::__construct($state, $profileFactory, $historyFactory, $helperData, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        if (!$pluginInfo) {
            return parent::run($input, $output);
        } else {
            return $this->___callPlugins('run', func_get_args(), $pluginInfo);
        }
    }
}
