<?php

/**
 * Product:       Xtento_GridActions
 * ID:            %!uniqueid!%
 * Last Modified: 2016-05-30T13:09:27+00:00
 * File:          Helper/Module.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\GridActions\Helper;

class Module extends \Xtento\XtCore\Helper\AbstractModule
{
    protected $edition = '%!version!%';
    protected $module = 'Xtento_GridActions';
    protected $extId = 'MTWOXtento_Spob152689';
    protected $configPath = 'gridactions/general/';

    // Module specific functionality below

    /**
     * @return bool
     */
    public function isModuleEnabled()
    {
        return parent::isModuleEnabled();
    }
}
