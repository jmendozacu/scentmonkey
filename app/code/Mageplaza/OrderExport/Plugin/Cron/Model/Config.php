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

namespace Mageplaza\OrderExport\Plugin\Cron\Model;

use Mageplaza\OrderExport\Model\ProfileFactory;

/**
 * Class Config
 * @package Mageplaza\OrderExport\Plugin\Cron\Model
 */
class Config
{
    /**
     * @var ProfileFactory
     */
    protected $profileFactory;

    /**
     * Config constructor.
     *
     * @param ProfileFactory $profileFactory
     */
    public function __construct(ProfileFactory $profileFactory)
    {
        $this->profileFactory = $profileFactory;
    }

    /**
     * @param \Magento\Cron\Model\Config $config
     * @param                            $result
     *
     * @return mixed
     */
    public function afterGetJobs(\Magento\Cron\Model\Config $config, $result)
    {
        $collection = $this->profileFactory->create()->getCollection();
        /** @var \Mageplaza\OrderExport\Model\Profile $profile */
        foreach ($collection as $profile) {
            $result['index']['mp_order_export_id_' . $profile->getId()] = [
                'name'     => 'mp_order_export_id_' . $profile->getId(),
                'instance' => 'Mageplaza\OrderExport\Cron\GenerateProfile',
                'method'   => 'execute',
                'schedule' => trim($profile->getCronSchedule())
            ];
        }

        return $result;
    }
}