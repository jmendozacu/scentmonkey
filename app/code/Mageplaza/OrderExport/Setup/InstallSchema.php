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

namespace Mageplaza\OrderExport\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Mageplaza\OrderExport\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();

        if (!$installer->tableExists('mageplaza_orderexport_profile')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('mageplaza_orderexport_profile'))
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true
                ], 'Profile Id')
                ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Profile Name')
                ->addColumn('status', Table::TYPE_INTEGER, 1, ['nullable' => false], 'Profile Status')
                ->addColumn('file_name', Table::TYPE_TEXT, 255, ['nullable' => false], 'File Name')
                ->addColumn('profile_type', Table::TYPE_TEXT, 255, ['nullable' => false], 'File Name')
                ->addColumn('add_timestamp', Table::TYPE_INTEGER, 1, ['nullable' => false], 'Add Time Stamp To File Name')
                ->addColumn('secret_key', Table::TYPE_TEXT, 255, ['nullable' => false], 'secret Key')
                ->addColumn('send_mail_after_export', Table::TYPE_INTEGER, 1, ['nullable' => false], 'Send Mail After Export')
                ->addColumn('auto_run', Table::TYPE_INTEGER, 1, ['nullable' => false], 'Auto Run Profile Depending On Cron')
                ->addColumn('cron_schedule', Table::TYPE_TEXT, 255, [], 'Cron Schedule')
                ->addColumn('file_type', Table::TYPE_TEXT, 64, ['nullable' => false], 'File Type')
                ->addColumn('export_type', Table::TYPE_INTEGER, 1, [], 'Export Type')
                ->addColumn('template_html', Table::TYPE_TEXT, '2M', [], 'Template Html')
                ->addColumn('fields_list', Table::TYPE_TEXT, '2M', [], 'Field List')
                ->addColumn('field_separate', Table::TYPE_TEXT, 64, [], 'Field Separate')
                ->addColumn('field_around', Table::TYPE_TEXT, 64, [], 'Field Around')
                ->addColumn('include_header', Table::TYPE_INTEGER, 1, [], 'Show Column Header')
                ->addColumn('status_condition', Table::TYPE_TEXT, 64, ['nullable' => false], 'Status Condition')
                ->addColumn('customer_groups', Table::TYPE_TEXT, 64, ['nullable' => false], 'Customer Groups')
                ->addColumn('store_ids', Table::TYPE_TEXT, 255, ['nullable' => false], 'Stores')
                ->addColumn('change_stt', Table::TYPE_TEXT, 32, [], 'Change Status')
                ->addColumn('created_from', Table::TYPE_TIMESTAMP, null, [], 'Created From')
                ->addColumn('created_to', Table::TYPE_TIMESTAMP, null, [], 'Created To')
                ->addColumn('order_id_from', Table::TYPE_INTEGER, null, [], 'Order Id From')
                ->addColumn('order_id_to', Table::TYPE_INTEGER, null, [], 'Order Id To')
                ->addColumn('item_id_from', Table::TYPE_INTEGER, null, [], 'Item Id From')
                ->addColumn('item_id_to', Table::TYPE_INTEGER, null, [], 'Item Id To')
                ->addColumn('export_duplicate', Table::TYPE_INTEGER, 1, ['nullable' => false], 'Export Duplicate')
                ->addColumn('exported_ids', Table::TYPE_TEXT, null, [], 'Exported Ids')
                ->addColumn('conditions_serialized', Table::TYPE_TEXT, '2M', [], 'Attribute Conditions')
                ->addColumn('last_cron', Table::TYPE_TIMESTAMP, null, [], 'Last Cron')
                ->addColumn('upload_enable', Table::TYPE_INTEGER, 1, [], 'Delivery Enable')
                ->addColumn('upload_type', Table::TYPE_TEXT, 64, [], 'Delivery Config: Protocol')
                ->addColumn('host_name', Table::TYPE_TEXT, 255, [], 'Delivery Config: Host Name')
                ->addColumn('user_name', Table::TYPE_TEXT, 255, [], 'Delivery Config: User Name')
                ->addColumn('password', Table::TYPE_TEXT, 255, [], 'Delivery Config: Password')
                ->addColumn('passive_mode', Table::TYPE_TEXT, 64, [], 'Delivery Config: Passive Mode')
                ->addColumn('directory_path', Table::TYPE_TEXT, 255, [], 'Delivery Config: Directory Path')
                ->addColumn('email_enable', Table::TYPE_INTEGER, 1, [], 'Email Enable')
                ->addColumn('sender', Table::TYPE_TEXT, 255, [], 'Email Sender')
                ->addColumn('email_subject', Table::TYPE_TEXT, 255, [], 'Email Subject')
                ->addColumn('send_email_to', Table::TYPE_TEXT, 255, [], 'Email To')
                ->addColumn('email_template', Table::TYPE_TEXT, 255, [], 'Email Template')
                ->addColumn('http_enable', Table::TYPE_INTEGER, 1, [], 'HTTP Request Enable')
                ->addColumn('http_url', Table::TYPE_TEXT, 255, [], 'HTTP Request Url')
                ->addColumn('http_header', Table::TYPE_TEXT, null, [], 'HTTP Request Header')
                ->addColumn('last_generated_file', Table::TYPE_TEXT, 255, [], 'Last Generated File')
                ->addColumn('last_generated', Table::TYPE_TIMESTAMP, null, [], 'Last Generated')
                ->addColumn('last_generated_product_count', Table::TYPE_INTEGER, null, [], 'Last Generated Product Count')
                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT], 'Created At')
                ->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT], 'Update At')
                ->setComment('Order Export Profile Table');

            $connection->createTable($table);
        }
        if (!$installer->tableExists('mageplaza_orderexport_defaulttemplate')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('mageplaza_orderexport_defaulttemplate'))
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true
                ], 'Template Id')
                ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Template Name')
                ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Template Title')
                ->addColumn('profile_type', Table::TYPE_TEXT, 255, ['nullable' => false], 'Template Title')
                ->addColumn('file_type', Table::TYPE_TEXT, 64, ['nullable' => false], 'Type')
                ->addColumn('template_html', Table::TYPE_TEXT, '2M', [], 'Template Html')
                ->addColumn('fields_list', Table::TYPE_TEXT, '2M', [], 'Field Map')
                ->addColumn('field_separate', Table::TYPE_TEXT, 64, [], 'Field Separate')
                ->addColumn('field_around', Table::TYPE_TEXT, 64, [], 'Field Around')
                ->addColumn('include_header', Table::TYPE_INTEGER, 1, [], 'Include Field Header')
                ->setComment('Default Template Table');

            $connection->createTable($table);
        }
        if (!$installer->tableExists('mageplaza_orderexport_history')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('mageplaza_orderexport_history'))
                ->addColumn('id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true
                ], 'Log Id')
                ->addColumn('profile_id', Table::TYPE_INTEGER, null, ['nullable' => false, 'unsigned' => true], 'Profile Id')
                ->addColumn('name', Table::TYPE_TEXT, 255, [], 'Profile Name')
                ->addColumn('generate_status', Table::TYPE_TEXT, 64, [], 'Generate Status')
                ->addColumn('delivery_status', Table::TYPE_TEXT, 64, [], 'Upload Status')
                ->addColumn('type', Table::TYPE_TEXT, 64, ['nullable' => false], 'Execution Type')
                ->addColumn('file', Table::TYPE_TEXT, 255, [], 'File')
                ->addColumn('product_count', Table::TYPE_INTEGER, null, [], 'Product Count')
                ->addColumn('message', Table::TYPE_TEXT, 512, [], 'Message')
                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT], 'Created At')
                ->addIndex($installer->getIdxName('mageplaza_orderexport_history', ['profile_id']), ['profile_id'])
                ->addForeignKey(
                    $installer->getFkName('mageplaza_orderexport_history', 'profile_id', 'mageplaza_orderexport_profile', 'id'),
                    'profile_id',
                    $installer->getTable('mageplaza_orderexport_profile'),
                    'id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Profile History Table');

            $connection->createTable($table);
        }
        $installer->endSetup();
    }
}
