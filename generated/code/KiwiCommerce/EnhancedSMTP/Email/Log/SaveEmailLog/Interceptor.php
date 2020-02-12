<?php
namespace KiwiCommerce\EnhancedSMTP\Email\Log\SaveEmailLog;

/**
 * Interceptor class for @see \KiwiCommerce\EnhancedSMTP\Email\Log\SaveEmailLog
 */
class Interceptor extends \KiwiCommerce\EnhancedSMTP\Email\Log\SaveEmailLog implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Mail\Template\FactoryInterface $templateFactory, \Magento\Framework\Mail\MessageInterface $message, \Magento\Framework\Mail\Template\SenderResolverInterface $senderResolver, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Mail\TransportInterfaceFactory $mailTransportFactory, ?\Magento\Framework\Mail\MessageInterfaceFactory $messageFactory, \KiwiCommerce\EnhancedSMTP\Model\LogsFactory $logsFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Request\Http $request, \KiwiCommerce\EnhancedSMTP\Helper\Config $config, \KiwiCommerce\EnhancedSMTP\Model\Logs\Status $status, \KiwiCommerce\EnhancedSMTP\Logger\Logger $logger, \KiwiCommerce\EnhancedSMTP\Helper\Benchmark $benchmark)
    {
        $this->___init();
        parent::__construct($templateFactory, $message, $senderResolver, $objectManager, $mailTransportFactory, $messageFactory, $logsFactory, $storeManager, $request, $config, $status, $logger, $benchmark);
    }

    /**
     * {@inheritdoc}
     */
    public function filterName($name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'filterName');
        if (!$pluginInfo) {
            return parent::filterName($name);
        } else {
            return $this->___callPlugins('filterName', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStoreId');
        if (!$pluginInfo) {
            return parent::getStoreId();
        } else {
            return $this->___callPlugins('getStoreId', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function initEmailLog()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'initEmailLog');
        if (!$pluginInfo) {
            return parent::initEmailLog();
        } else {
            return $this->___callPlugins('initEmailLog', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRecipientName($key)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRecipientName');
        if (!$pluginInfo) {
            return parent::getRecipientName($key);
        } else {
            return $this->___callPlugins('getRecipientName', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sendLog($emailLog, $recipient, $name)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'sendLog');
        if (!$pluginInfo) {
            return parent::sendLog($emailLog, $recipient, $name);
        } else {
            return $this->___callPlugins('sendLog', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isAllowed()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isAllowed');
        if (!$pluginInfo) {
            return parent::isAllowed();
        } else {
            return $this->___callPlugins('isAllowed', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRecipients()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRecipients');
        if (!$pluginInfo) {
            return parent::getRecipients();
        } else {
            return $this->___callPlugins('getRecipients', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRecipientsNameByEmail($email)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRecipientsNameByEmail');
        if (!$pluginInfo) {
            return parent::getRecipientsNameByEmail($email);
        } else {
            return $this->___callPlugins('getRecipientsNameByEmail', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function prepareMessage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepareMessage');
        if (!$pluginInfo) {
            return parent::prepareMessage();
        } else {
            return $this->___callPlugins('prepareMessage', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addCc($address, $name = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addCc');
        if (!$pluginInfo) {
            return parent::addCc($address, $name);
        } else {
            return $this->___callPlugins('addCc', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addTo($address, $name = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addTo');
        if (!$pluginInfo) {
            return parent::addTo($address, $name);
        } else {
            return $this->___callPlugins('addTo', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addBcc($address)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addBcc');
        if (!$pluginInfo) {
            return parent::addBcc($address);
        } else {
            return $this->___callPlugins('addBcc', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setReplyTo($email, $name = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setReplyTo');
        if (!$pluginInfo) {
            return parent::setReplyTo($email, $name);
        } else {
            return $this->___callPlugins('setReplyTo', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setFrom($from)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFrom');
        if (!$pluginInfo) {
            return parent::setFrom($from);
        } else {
            return $this->___callPlugins('setFrom', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setFromByScope($from, $scopeId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setFromByScope');
        if (!$pluginInfo) {
            return parent::setFromByScope($from, $scopeId);
        } else {
            return $this->___callPlugins('setFromByScope', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateIdentifier($templateIdentifier)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateIdentifier');
        if (!$pluginInfo) {
            return parent::setTemplateIdentifier($templateIdentifier);
        } else {
            return $this->___callPlugins('setTemplateIdentifier', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateModel($templateModel)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateModel');
        if (!$pluginInfo) {
            return parent::setTemplateModel($templateModel);
        } else {
            return $this->___callPlugins('setTemplateModel', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateVars($templateVars)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateVars');
        if (!$pluginInfo) {
            return parent::setTemplateVars($templateVars);
        } else {
            return $this->___callPlugins('setTemplateVars', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setTemplateOptions($templateOptions)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTemplateOptions');
        if (!$pluginInfo) {
            return parent::setTemplateOptions($templateOptions);
        } else {
            return $this->___callPlugins('setTemplateOptions', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTransport()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTransport');
        if (!$pluginInfo) {
            return parent::getTransport();
        } else {
            return $this->___callPlugins('getTransport', func_get_args(), $pluginInfo);
        }
    }
}
