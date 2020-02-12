<?php
namespace Xtento\TrackingImport\Console\Command\ConfigImportCommand;

/**
 * Interceptor class for @see \Xtento\TrackingImport\Console\Command\ConfigImportCommand
 */
class Interceptor extends \Xtento\TrackingImport\Console\Command\ConfigImportCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\State $appState, \Xtento\TrackingImport\Helper\Tools\Proxy $toolsHelper)
    {
        $this->___init();
        parent::__construct($appState, $toolsHelper);
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
