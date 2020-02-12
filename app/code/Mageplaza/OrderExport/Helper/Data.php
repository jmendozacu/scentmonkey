<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_OrderExport
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\OrderExport\Helper;

use Liquid\Template;
use Magento\Backend\Model\UrlInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\App\Area;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Filesystem\Io\Ftp;
use Magento\Framework\Filesystem\Io\Sftp;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory as CreditmemoCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory as InvoiceCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory as ShipmentCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Mageplaza\Core\Helper\AbstractData as CoreHelper;
use Mageplaza\OrderExport\Block\Adminhtml\LiquidFilters;
use Mageplaza\OrderExport\Mail\Template\TransportBuilder;
use Mageplaza\OrderExport\Model\Config\Source\Events;
use Mageplaza\OrderExport\Model\Config\Source\ExportType;
use Mageplaza\OrderExport\Model\Config\Source\FieldsSeparate;
use Mageplaza\OrderExport\Model\Config\Source\FileType;
use Mageplaza\OrderExport\Model\Profile;

/**
 * Class Data
 * @package Mageplaza\OrderExport\Helper
 */
class Data extends CoreHelper
{
    const CONFIG_MODULE_PATH = 'mp_order_export';
    const XML_PATH_EMAIL     = 'email';
    const PROFILE_FILE_PATH  = BP . '/pub/media/mageplaza/order_export/profile';
    const EMAIL_TEMPLATE_ID  = 'mp_order_export_alert_email_template';

    /**
     * @var File
     */
    protected $file;

    /**
     * @var LiquidFilters
     */
    protected $liquidFilters;

    /**
     * @var Ftp
     */
    protected $ftp;

    /**
     * @var Sftp
     */
    protected $sftp;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var UrlInterface
     */
    protected $backendUrl;

    /**
     * @var JsonHelper
     */
    protected $jsonHelper;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var GroupRepositoryInterface
     */
    protected $groupRepository;

    /**
     * @var InvoiceCollectionFactory
     */
    protected $invoiceCollectionFactory;

    /**
     * @var ShipmentCollectionFactory
     */
    protected $shipmentCollectionFactory;

    /**
     * @var CreditmemoCollectionFactory
     */
    protected $creditmemoCollectionFactory;

    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var CurlFactory
     */
    protected $curlFactory;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param ObjectManagerInterface $objectManager
     * @param StoreManagerInterface $storeManager
     * @param OrderFactory $orderFactory
     * @param InvoiceCollectionFactory $invoiceCollectionFactory
     * @param ShipmentCollectionFactory $shipmentCollectionFactory
     * @param CreditmemoCollectionFactory $creditmemoCollectionFactory
     * @param GroupRepositoryInterface $groupRepository
     * @param UrlInterface $backendUrl
     * @param Ftp $ftp
     * @param Sftp $sftp
     * @param CurlFactory $curlFactory
     * @param JsonHelper $jsonHelper
     * @param TransportBuilder $transportBuilder
     * @param DateTime $date
     * @param DirectoryList $directoryList
     * @param File $file
     * @param LiquidFilters $liquidFilters
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        StoreManagerInterface $storeManager,
        OrderFactory $orderFactory,
        InvoiceCollectionFactory $invoiceCollectionFactory,
        ShipmentCollectionFactory $shipmentCollectionFactory,
        CreditmemoCollectionFactory $creditmemoCollectionFactory,
        GroupRepositoryInterface $groupRepository,
        UrlInterface $backendUrl,
        Ftp $ftp,
        Sftp $sftp,
        CurlFactory $curlFactory,
        JsonHelper $jsonHelper,
        TransportBuilder $transportBuilder,
        DateTime $date,
        DirectoryList $directoryList,
        File $file,
        LiquidFilters $liquidFilters
    )
    {
        $this->orderFactory                = $orderFactory;
        $this->invoiceCollectionFactory    = $invoiceCollectionFactory;
        $this->shipmentCollectionFactory   = $shipmentCollectionFactory;
        $this->creditmemoCollectionFactory = $creditmemoCollectionFactory;
        $this->groupRepository             = $groupRepository;
        $this->file                        = $file;
        $this->liquidFilters               = $liquidFilters;
        $this->ftp                         = $ftp;
        $this->sftp                        = $sftp;
        $this->date                        = $date;
        $this->transportBuilder            = $transportBuilder;
        $this->backendUrl                  = $backendUrl;
        $this->jsonHelper                  = $jsonHelper;
        $this->directoryList               = $directoryList;
        $this->curlFactory                 = $curlFactory;

        parent::__construct($context, $objectManager, $storeManager);
    }

    /**
     * @param $profile
     *
     * @return array
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function sendHttpRequest($profile)
    {
        die('yea');
        $url           = $profile->getHttpUrl();
        $headersConfig = $profile->getHttpHeader() ? explode("\n", $profile->getHttpHeader()) : [];

        $headers = [];
        foreach ($headersConfig as $item) {
            list($key, $value) = explode(":", $item);
            $header[trim($key)] = trim($value);
        }

        $fileName = $profile->getLastGeneratedFile();
        $filePath = $this->getFilePath($fileName);
        $content  = file_get_contents($filePath);
        $curl     = $this->curlFactory->create();
        $curl->write(\Zend_Http_Client::POST, $url, '1.1', $headers, $content);
        
        $result = ['success' => false];
        try {
            $resultCurl = $curl->read();
            if (!empty($resultCurl)) {
                $result['status'] = \Zend_Http_Response::extractCode($resultCurl);
                if (isset($result['status']) && in_array($result['status'], [200, 201])) {
                    $result['success'] = true;
                } else {
                    $result['message'] = __('Cannot connect to server. Please try again later.');
                }
            } else {
                $result['message'] = __('Cannot connect to server. Please try again later.');
            }
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
        }

        $curl->close();

        return $result;
    }

    /**
     * @param string $code
     * @param null $storeId
     *
     * @return mixed
     */
    public function getEmailConfig($code = '', $storeId = null)
    {
        $code = ($code !== '') ? '/' . $code : '';

        return $this->getModuleConfig(self::XML_PATH_EMAIL . $code, $storeId);
    }

    /**
     * @param     $profile
     * @param int $generateStt
     * @param int $deliveryStt
     */
    public function sendAlertMail($profile, $generateStt = Events::GENERATE_DISABLE, $deliveryStt = Events::DELIVERY_DISABLE)
    {
        if (!$this->getEmailConfig('enabled')) {
            return;
        }

        switch ($generateStt) {
            case Events::GENERATE_SUCCESS:
                $genMes   = __('Profile %1 is generated successfully', $profile->getName());
                $genStyle = 'color: green';
                break;
            case Events::GENERATE_ERROR:
                $genMes   = __('Profile %1 fails to be generated', $profile->getName());
                $genStyle = 'color: red';
                break;
            default:
                $genMes   = '';
                $genStyle = '';
                break;
        }

        switch ($deliveryStt) {
            case Events::DELIVERY_SUCCESS:
                $deMes   = __('Profile %1 is delivery successfully', $profile->getName());
                $deStyle = 'color: green';
                break;
            case Events::DELIVERY_ERROR:
                $deMes   = __('Profile %1 fails to be delivered', $profile->getName());
                $deStyle = 'color: red';
                break;
            default:
                $deMes   = '';
                $deStyle = '';
                break;
        }

        $generateMes = '<p style="' . $genStyle . '">' . $genMes . '</p>';
        $deliveryMes = '<p style="' . $deStyle . '">' . $deMes . '</p>';

        $events  = explode(',', $this->getEmailConfig('events'));
        $sendTo  = explode(',', $this->getEmailConfig('send_to'));
        $storeId = 0;
        if (in_array($generateStt, $events) || in_array($deliveryStt, $events)) {
            $this->sendMail(
                $profile->getSender(),
                $sendTo,
                $generateMes . $deliveryMes,
                self::EMAIL_TEMPLATE_ID,
                $storeId
            );
        }
    }

    /**
     * @param $sendFrom
     * @param $sendTo
     * @param $mes
     * @param $emailTemplate
     * @param $storeId
     *
     * @return bool
     */
    public function sendMail($sendFrom, $sendTo, $mes, $emailTemplate, $storeId)
    {
        try {
            $this->transportBuilder
                ->setTemplateIdentifier($emailTemplate)
                ->setTemplateOptions([
                    'area'  => Area::AREA_FRONTEND,
                    'store' => $storeId,
                ])
                ->setTemplateVars([
                    'viewLogUrl' => $this->backendUrl->getUrl('mporderexport/logs/'),
                    'mes'        => $mes
                ])
                ->setFrom($sendFrom)
                ->addTo($sendTo);
            $transport = $this->transportBuilder->getTransport();
            $transport->sendMessage();

            return true;
        } catch (\Magento\Framework\Exception\MailException $e) {
            $this->_logger->critical($e->getLogMessage());
        }

        return false;
    }

    /**
     * @param $profile
     *
     * @return bool
     * @throws \Magento\Framework\Exception\FileSystemException*@throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function sendExportedFileViaMail($profile)
    {
        $storeId       = 0;
        $emailTemplate = $profile->getEmailTemplate();
        $emailSubject  = $profile->getEmailSubject();
        $sendFrom      = $profile->getSender();
        $sendTo        = explode(',', $profile->getSendEmailTo());
        $fileName      = $profile->getlastGeneratedFile();
        $filePath      = $this->directoryList->getPath(DirectoryList::MEDIA) . '/mageplaza/order_export/profile/' . $profile->getlastGeneratedFile();
        $attachment    = $this->file->read($filePath);
        $mes           = __('File exported by profile %1. You can download it in the attachment.', $profile->getName());

        try {
            $store = $this->storeManager->getStore($storeId);
            $this->transportBuilder
                ->setTemplateIdentifier($emailTemplate)
                ->setTemplateOptions([
                    'area'  => Area::AREA_FRONTEND,
                    'store' => $storeId,
                ])
                ->setTemplateVars([
                    'viewLogUrl'   => $this->backendUrl->getUrl('mporderexport/logs/'),
                    'mes'          => $mes,
                    'emailSubject' => $emailSubject ?: __('%1 send you exported file', $store->getName()),
                ])
                ->setFrom($sendFrom)
                ->addTo($sendTo);
            if ($attachment) {
                $this->transportBuilder->addAttachment($attachment, $fileName);
            }
            $transport = $this->transportBuilder->getTransport();
            $transport->sendMessage();

            return true;
        } catch (\Magento\Framework\Exception\MailException $e) {
            $this->_logger->critical($e->getLogMessage());
        }

        return false;
    }

    /**
     * @param $protocol
     * @param $host
     * @param $passive
     * @param $user
     * @param $pass
     *
     * @return bool|\phpseclib\Net\SFTP|true
     */
    public function checkConnection($protocol, $host, $passive, $user, $pass)
    {
        try {
            if ($protocol == 'sftp') {
                $connection = $this->connectToHost('sftp', $host, $passive, $user, $pass);

                return $connection->login($user, $pass);
            } else {
                return $this->connectToHost('ftp', $host, $passive, $user, $pass);
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e->getLogMessage());

            return false;
        }
    }

    /**
     * @param $protocol
     * @param $host
     * @param $passive
     * @param $user
     * @param $pass
     * @param int $timeout
     *
     * @return \phpseclib\Net\SFTP|true
     * @throws \Exception
     */
    public function connectToHost($protocol, $host, $passive, $user, $pass, $timeout = Sftp::REMOTE_TIMEOUT)
    {
        try {
            if ($protocol == 'sftp') {
                if (strpos($host, ':') !== false) {
                    list($host, $port) = explode(':', $host, 2);
                } else {
                    $port = Sftp::SSH2_PORT;
                }
                $connection = new \phpseclib\Net\SFTP($host, $port, $timeout);

                return $connection;
            } else {
                $open = $this->ftp->open([
                    'host'     => $host,
                    'user'     => $user,
                    'password' => $pass,
                    'ssl'      => true,
                    'passive'  => $passive
                ]);

                return $open;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $profile \Mageplaza\OrderExport\Model\Profile
     *
     * @throws \Exception
     */
    public function deliveryProfile($profile)
    {
        $host          = $profile->getHostName();
        $username      = $profile->getUserName();
        $password      = $profile->getPassword();
        $timeout       = '20';
        $passiveMode   = $profile->getPassiveMode();
        $fileName      = $profile->getLastGeneratedFile();
        $filePath      = $this->getFilePath($fileName);
        $directoryPath = trim($profile->getDirectoryPath());

        if ($directoryPath && strripos($directoryPath, '/') !== (strlen($directoryPath) - 1)) {
            $directoryPath .= '/';
        }
        $directoryPath .= $fileName;

        try {
            if ($profile->getUploadType() == 'sftp') {
                // Fix Magento bug in 2.1.x
                $content    = file_get_contents($filePath);
                $mode       = is_readable($content)
                    ? \phpseclib\Net\SFTP::SOURCE_LOCAL_FILE
                    : \phpseclib\Net\SFTP::SOURCE_STRING;
                $connection = $this->connectToHost('sftp', $host, $passiveMode, $username, $password, $timeout);
                if (!$connection->login($username, $password)) {
                    throw new \Exception(__("Unable to open SFTP connection as %1@%2", $username, $password));
                }
                $connection->put($directoryPath, $content, $mode);
                $connection->disconnect();
            } else {
                $this->connectToHost('ftp', $host, $passiveMode, $username, $password);
                $content = file_get_contents($filePath);
                $this->ftp->write($directoryPath, $content);
                $this->ftp->close();
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e->getMessage());
        }
    }

    /**
     * @param $profile
     * @param array $ids
     * @param bool $preview
     * @return array
     * @throws LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function generateLiquidTemplate($profile, $ids = [], $preview = false)
    {
        $template       = new Template;
        $filtersMethods = $this->liquidFilters->getFiltersMethods();

        $template->registerFilter($this->liquidFilters);
        $profileType = $profile->getProfileType();
        $fileType    = $profile->getFileType();
        list($collection, $maxItemCount) = $this->getProfileData($profile, $ids, $preview);

        if ($fileType == FileType::EXCEL_XML || $fileType == FileType::XML || $fileType == FileType::JSON) {
            $templateHtml = $profile->getTemplateHtml();
        } else {
            $fieldSeparate = $this->getFieldSeparate($profile->getFieldSeparate());
            $fieldAround   = $profile->getFieldAround() == 'none' ? ''
                : ($profile->getFieldAround() == 'quote' ? "'" : '"');
            $includeHeader = $profile->getIncludeHeader();
            $fieldsMap     = $this->jsonHelper->jsonDecode($profile->getFieldsList() ?: '{}');
            if (empty($fieldsMap)) {
                return ['', []];
            }
            if ($profile->getExportType() == ExportType::LOOP_ORDER) {
                $row = [];
                foreach ($fieldsMap as $field) {
                    if ($field['col_type'] == 'item' && isset($field['items'])) {
                        foreach ($field['items'] as $item) {
                            $row[0][]      = $item['name'];
                            $itemLiquidVal = '{{ item.' . $item['value'];
                            if (isset($item['modifiers'])) {
                                foreach ($item['modifiers'] as $modifier) {
                                    $itemLiquidVal .= ' | ' . $modifier['value'];
                                    if (isset($modifier['params'])) {
                                        $itemLiquidVal .= ': ';
                                        foreach ($modifier['params'] as $key => $param) {
                                            if ($key == (count($modifier['params']) - 1)) {
                                                $itemLiquidVal .= $param;
                                            } else {
                                                $itemLiquidVal .= $param . ', ';
                                            }
                                        }
                                    }
                                }
                            }
                            $itemLiquidVal .= ' }}';
                            $row[1][]      = $fieldAround . $itemLiquidVal . $fieldAround;
                        }
                    } else {
                        $row[0][] = $field['col_name'];
                        if ($field['col_type'] == 'attribute') {
                            $row[1][] = $fieldAround . $field['col_val'] . $fieldAround;
                        } else {
                            $row[1][] = $fieldAround . $field['col_pattern_val'] . $fieldAround;
                        }
                    }
                }
                $row[0] = implode($fieldSeparate, $row[0]);
                $row[1] = implode($fieldSeparate, $row[1]);

                if ($includeHeader) {
                    $templateHtml = $row[0] . '
' . '{% for ' . $profileType . ' in collection %}{% for item in ' . $profileType . '.items %}{% if item.product_type != "configurable" %}' . $row[1] . '
{% endif %}{% endfor %}{% endfor %}';
                } else {
                    $templateHtml = '{% for ' . $profileType . ' in collection %}{% for item in ' . $profileType . '.items %}{% if item.product_type != "configuration" %}' . $row[1] . '
{% endif %}{% endfor %}{% endfor %}';
                }
            } else {
                $row = [];
                foreach ($fieldsMap as $field) {
                    if ($field['col_type'] == 'item') {
                        $items          = $field['items'];
                        $liquidItemsVal = [];

                        for ($i = 1; $i <= $maxItemCount; $i++) {
                            foreach ($items as $item) {
                                $row[0][] = 'item ' . $i . '(' . $item['name'] . ')';
                            }
                        }
                        foreach ($items as $item) {
                            $liquidVal = '';
                            if ($item) {
                                $liquidVal .= '{{ item.' . $item['value'];
                                if (isset($item['modifiers'])) {
                                    foreach ($item['modifiers'] as $modifier) {
                                        $liquidVal .= ' | ' . $modifier['value'];
                                        if (isset($modifier['params'])) {
                                            $liquidVal .= ': ';
                                            foreach ($modifier['params'] as $key => $param) {
                                                if ($key == (count($modifier['params']) - 1)) {
                                                    $liquidVal .= $param;
                                                } else {
                                                    $liquidVal .= $param . ', ';
                                                }
                                            }
                                        }
                                    }
                                }
                                $liquidVal .= ' }}';
                            }
                            $liquidItemsVal[] = $fieldAround . $liquidVal . $fieldAround;
                        }
                        $itemVariableCount = count($items);
                        $liquidItemsVal    = implode($fieldSeparate, $liquidItemsVal);
                        $liquidItemsVal    = '{% for item in ' . $profileType . '.items %}{% if forloop.last == true %}'
                            . $liquidItemsVal . '{% else %}' . $liquidItemsVal . $fieldSeparate .
                            '{% endif %}{% endfor %}{% if '
                            . $profileType . '.items.size < maxItemCount %}{% for n in (1..' . $itemVariableCount
                            . ') %}{% for i in (' . $profileType . '.items.size..maxItemCount1) %}'
                            . $fieldSeparate . $fieldAround . $fieldAround . '{% endfor %}{% endfor %}{% endif %}';
                        $row[1][]          = $liquidItemsVal;
                        continue;
                    }

                    $row[0][] = $field['col_name'];
                    if ($field['col_type'] == 'attribute') {
                        $row[1][] = $fieldAround . $field['col_val'] . $fieldAround;
                    } else {
                        $row[1][] = $fieldAround . $field['col_pattern_val'] . $fieldAround;
                    }
                }

                $row[0] = implode($fieldSeparate, $row[0]);
                $row[1] = implode($fieldSeparate, $row[1]);

                if ($includeHeader) {
                    $templateHtml = $row[0] . '
' . '{% for ' . $profileType . ' in collection %}' . $row[1] . '
{% endfor %}';
                } else {
                    $templateHtml = '{% for ' . $profileType . ' in collection %}' . $row[1] . '
{% endfor %}';
                }
            }
        }
        $templateHtml = str_replace('}}', "| mpCorrect: '" . $profile->getFieldAround()
            . "', '" . $profile->getFieldSeparate() . "'}}", $templateHtml);
        array_push($filtersMethods, 'mpCorrect');

        $template->parse($templateHtml, $filtersMethods);
        $content = $template->render([
            'collection'    => $collection,
            'maxItemCount'  => $maxItemCount,
            'maxItemCount1' => $maxItemCount - 1,
        ]);
        //santhosh edited this to remove blank lines
        $content = preg_replace('/^\h*\v+/m', '', $content);

        //change content here for right xml
        return [$content, $collection->getAllIds()];
    }

    /**
     * @param $profile
     * @param bool $skipCondition
     * @return int
     * @throws LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function generateProfile($profile, $skipCondition = false)
    {
        list($content, $ids) = $this->generateLiquidTemplate($profile); 
        $profile->setLastGenerated($this->date->date());
        $fileName = $profile->getFileName();
        if ($profile->getAddTimestamp()) {
            $fileName .= '_' . $this->date->date('Ymd_His');
        }
        $fileName .= '.' . $this->getFileType($profile->getFileType());
       
        $this->createProfileFile($fileName, $content);
       
        $profile->setLastGeneratedFile($fileName);
        if (!$skipCondition) {
            $profile->setLastGeneratedProductCount(count($ids));
            if (!$profile->getExportDuplicate()) {
                $exportedIds = $profile->getExportedIds();
                $exportedIds = $exportedIds ? explode(',', $exportedIds) : [];
                $exportedIds = array_unique(array_merge($exportedIds, $ids));
                $profile->setExportedIds(implode(',', $exportedIds));
            }
            if (!empty($ids) &&
                ($profile->getProfileType() == Profile::TYPE_ORDER)
                && ($changeStt = $profile->getChangeStt())
            ) {
                $orderCollection = $this->orderFactory->create()->getCollection()
                    ->addFieldToFilter('entity_id', ['in' => $ids]);
                /** @var \Magento\Sales\Model\Order $order */
                foreach ($orderCollection as $order) {
                    $order->setStatus($changeStt)->save();
                }
            }
        }
        $profile->save();

        return count($ids);
    }

    /**
     * @param $fileName
     * @param $content
     * @throws \Exception
     */
    public function createProfileFile($fileName, $content)
    {
        $this->file->checkAndCreateFolder(self::PROFILE_FILE_PATH);
        $fileUrl = self::PROFILE_FILE_PATH . '/' . $fileName;
       
        $this->file->write($fileUrl, $content, 0777);
        
    }

    /**
     * @param $fileType
     * @return string
     */
    public function getFileType($fileType)
    {
        switch ($fileType) {
            case FileType::XML:
            case FileType::EXCEL_XML:
                return 'xml';
            case FileType::CSV:
                return 'csv';
            case FileType::TSV:
                return 'tsv';
            case FileType::JSON:
                return 'json';
            default:
                return 'txt';
        }
    }

    /**
     * @param $fieldSeparate
     * @return string
     */
    public function getFieldSeparate($fieldSeparate)
    {
        switch ($fieldSeparate) {
            case FieldsSeparate::TAB:
                return "\t";
            case FieldsSeparate::SEMICOLON:
                return ";";
            case FieldsSeparate::COLON:
                return ":";
            case FieldsSeparate::VERTICAL_BAR:
                return "|";
            default:
                return ",";
        }
    }

    /**
     * @param $profile
     * @param array $ids
     * @param bool $preview
     * @return array
     * @throws LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProfileData($profile, $ids = [], $preview = false)
    {
       
        if (!$preview) {
            if ($ids) {
                $matchingItemIds = $ids;
            } else {
                $matchingItemIds = $profile->getMatchingItemIds();
            }
        }

        switch ($profile->getProfileType()) {
            case Profile::TYPE_INVOICE:
                $collection = $this->invoiceCollectionFactory->create();
                break;
            case Profile::TYPE_SHIPMENT:
                $collection = $this->shipmentCollectionFactory->create();
                break;
            case Profile::TYPE_CREDITMEMO:
                $collection = $this->creditmemoCollectionFactory->create();
                break;
            default:
                $collection = $this->orderFactory->create()->getCollection();
        }
        if ($preview) {
           // $collection->setPageSize(5);
        } else {
            $collection->addFieldToFilter('entity_id', ['in' => $matchingItemIds]);
        }
        $maxItemCount = 0;
        /** @var $item \Magento\Sales\Model\Order\Creditmemo
         */
        foreach ($collection as $item) {
           
            if ($item->getShippingAddress()) {
                $item->setData('newregion', $item->getShippingAddress()->getRegioncode());
                $item->setData('shippingAddress', $item->getShippingAddress()->getData());
            }
            if ($item->getBillingAddress()) {
                $item->setData('bnewregion', $item->getBillingAddress()->getRegioncode());
                $item->setData('billingAddress', $item->getBillingAddress()->getData());
            }
            if (count($item->getItems()) > $maxItemCount) {
                $maxItemCount = count($item->getItems());
            }
            $item->setData('newavsresponse', "testing");
           //santhosh edited this to add Fraud Detection details
           if($item->getPayment()->getMethod() == "authorizenet_directpost"){
            //echo 'acha teek hai';
           // echo $item->getId();
            //print_r($item->getPayment()->getAdditionalInformation());
            $fraudDetails = $item->getPayment()->getAdditionalInformation();
            if(isset($fraudDetails['fraud_details'])){
                //echo $fraudDetails['fraud_details']['avs_response'];
               // echo  $fraudDetails['fraud_details']['card_code_response'];
             
                //$item->setData('avs_response', $fraudDetails['fraud_details']['avs_response']);
                $item->setData('avsresponse', $fraudDetails['fraud_details']['avs_response']);
                
                $item->setData('cardcoderesponse', $fraudDetails['fraud_details']['card_code_response']);
                
             // print_r($fraudDetails['fraud_details']);
            }
            //Sat Mar 23 23:27:26 2019 GMT
            //$item->setData('time', Date('D M d H:i:s Y T'));
            //$item->setData('strtotime', strtotime(Date()));
            
            //print_r(Date('D M d H:i:s Y T'));
           // print_r(strtotime(Date()));
           // die;

           // $item->setData('avs_response', $fraudDetails['fraud_details']['avs_response']);
           // $item->setData('card_code_response', $fraudDetails['fraud_details']['card_code_response']);
            
        // die;   
        }

            /** @var \Magento\Sales\Model\Order\Item $it */
            foreach ($item->getItems() as $it) {
                $it->setStatus($it->getStatus());
            }
            $order = $item->getOrder();

           
            //print_r(Profile::TYPE_ORDER);
            //die('its coming here');
            if ($profile->getProfileType() != Profile::TYPE_ORDER) {
                $item->setCustomerFirstname($order->getCustomerFirstname());
                $item->setCustomerLastname($order->getCustomerLastname());
                $item->setCustomerEmail($order->getCustomerEmail());
                $item->setShippingDescription($order->getShippingDescription());
                $item->setPaymentMethod($order->getPayment()->getMethod());
                $item->setStoreName($order->getStoreName());
                $item->setOrderDate($order->getCreatedAt());
                $item->setCustomerGroup($this->groupRepository->getById($order->getCustomerGroupId())->getCode());
            }
            switch ($profile->getProfileType()) {
                case Profile::TYPE_INVOICE:
                    $item->setStateName($item->getStateName());
                    $item->setStateName($order->getStateName());

                    break;
                case Profile::TYPE_SHIPMENT:
                    $item->setOrderStatus($order->getStatus());
                    break;
                case Profile::TYPE_CREDITMEMO:
                    $item->setStateName($item->getStateName());
                    break;
                default:
                    $item->setPaymentMethod($item->getPayment()->getMethod());
                    $item->setCustomerGroup($this->groupRepository->getById($item->getCustomerGroupId())->getCode());
            }
             
        }

        return [$collection, $maxItemCount];
    }

    /**
     * @param $filename
     * @return string
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getFilePath($filename)
    {
        return $this->directoryList->getPath(DirectoryList::MEDIA)
            . '/mageplaza/order_export/profile/' . $filename;
    }
}
