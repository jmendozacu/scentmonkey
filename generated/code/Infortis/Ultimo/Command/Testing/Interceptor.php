<?php
namespace Infortis\Ultimo\Command\Testing;

/**
 * Interceptor class for @see \Infortis\Ultimo\Command\Testing
 */
class Interceptor extends \Infortis\Ultimo\Command\Testing implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Infortis\Ultimo\Helper\GetWebsiteCode $getWebsiteCode, \Infortis\Ultimo\Helper\GetNowBasedOnLocale $getNowBasedOnLocale, $name = null)
    {
        $this->___init();
        parent::__construct($getWebsiteCode, $getNowBasedOnLocale, $name);
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
