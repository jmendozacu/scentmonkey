<?php

/**
 * Product:       Xtento_TrackingImport
 * ID:            ItQwyW4WJhvrgfQ9+PrUqQTIHQ1Q7mfhy7NFERkjhFA=
 * Last Modified: 2019-02-25T14:31:23+00:00
 * File:          app/code/Xtento/TrackingImport/Helper/GracefulDie.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\TrackingImport\Helper;

use Xtento\TrackingImport\Model\Log;

class GracefulDie
{
    protected static $isInitialized = false;
    protected static $isEnabled = false;

    public static function enable()
    {
        self::$isEnabled = true;
        if (!self::$isInitialized) {
            register_shutdown_function(['\Xtento\TrackingImport\Helper\GracefulDie', 'beforeDieFromShutdown']); // Fatal error or similar
            if (extension_loaded('pcntl') && function_exists('pcntl_signal')) {
                declare(ticks=1);
                pcntl_signal(SIGINT, ['\Xtento\TrackingImport\Helper\GracefulDie', 'beforeDieFromSigint']); // Control + C
                pcntl_signal(SIGTERM, ['\Xtento\TrackingImport\Helper\GracefulDie', 'beforeDieFromSigterm']); // Process killed
            }
            self::$isInitialized = true;
        }
    }

    public static function disable()
    {
        self::$isEnabled = false;
    }

    /**
     * @param null $message
     * @param bool $exit
     */
    public static function beforeDie($message = null, $exit = false)
    {
        if (self::$isEnabled) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $registry = $objectManager->get('\Magento\Framework\Registry');
            $logEntry = $registry->registry('trackingimport_log');
            if ($logEntry && $logEntry->getId()) {
                $logEntry->setResult(Log::RESULT_FAILED);
                $logEntry->setResultMessage($message);
                $logEntry->save();
            }
            if ($exit) {
                exit;
            }
        }
    }

    public static function beforeDieFromShutdown()
    {
        $message = 'Shutdown/Crash: ' . print_r(error_get_last(), true);
        //'Stack Trace: ' . PHP_EOL . (new \Exception())->__toString();

        self::beforeDie($message, false);
    }

    public static function beforeDieFromSigint()
    {
        self::beforeDie('Script execution stopped. (SIGNAL SIGINT, CTRL+C)', true);
    }

    public static function beforeDieFromSigterm()
    {
        self::beforeDie('Script execution stopped. (SIGNAL SIGTERM, Process killed)', true);
    }
}