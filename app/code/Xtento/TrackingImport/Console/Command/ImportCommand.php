<?php

/**
 * Product:       Xtento_TrackingImport
 * ID:            ItQwyW4WJhvrgfQ9+PrUqQTIHQ1Q7mfhy7NFERkjhFA=
 * Last Modified: 2017-09-20T19:16:19+00:00
 * File:          app/code/Xtento/TrackingImport/Console/Command/ImportCommand.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\TrackingImport\Console\Command;

use Magento\Framework\App\State as AppState;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    /**
     * @var AppState
     */
    protected $appState;

    /**
     * @var \Xtento\TrackingImport\Model\ProfileFactory
     */
    protected $profileFactory;

    /**
     * @var \Xtento\TrackingImport\Model\ImportFactory
     */
    protected $importFactory;

    /**
     * ImportCommand constructor.
     *
     * @param \Xtento\TrackingImport\Model\ProfileFactory $profileFactory
     * @param \Xtento\TrackingImport\Model\ImportFactory $importFactory
     */
    public function __construct(
        AppState $appState,
        \Xtento\TrackingImport\Model\ProfileFactory $profileFactory,
        \Xtento\TrackingImport\Model\ImportFactory $importFactory
    ) {
        /*try {
            //https://magento.stackexchange.com/questions/152089/magento2-command-line-sending-email-using-block-templates-error-missing-r
            $appState->setAreaCode('adminhtml');
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            // intentionally left empty
        }*/
        $this->appState = $appState;
        $this->profileFactory = $profileFactory;
        $this->importFactory = $importFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('xtento:trackingimport:import')
            ->setDescription('Import XTENTO tracking import profile.')
            ->setDefinition(
                [
                    new InputArgument(
                        'profile',
                        InputArgument::REQUIRED,
                        'Profile IDs to import (multiple IDs: comma-separated)'
                    )
                ]
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->appState->setAreaCode('adminhtml');
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            // intentionally left empty
        }
        echo(sprintf("[Debug] App Area: %s\n", $this->appState->getAreaCode())); // Required to avoid "area code not set" error

        $profileIds = explode(",", $input->getArgument('profile'));
        if (empty($profileIds)) {
            $output->writeln("<error>Profile IDs to import missing.</error>");
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }

        foreach ($profileIds as $profileId) {
            $profileId = intval($profileId);
            if ($profileId < 1) {
                $output->writeln("<error>Invalid profile ID: %s</error>", $profileId);
                continue;
            }

            try {
                $profile = $this->profileFactory->create()->load($profileId);
                if (!$profile->getId()) {
                    $output->writeln(sprintf("<error>Profile ID %d does not exist.</error>", $profileId));
                    continue;
                }
                if (!$profile->getEnabled()) {
                    $output->writeln(sprintf("<error>Profile ID %d is disabled.</error>", $profileId));
                    continue;
                }

                $output->writeln(sprintf("<info>Importing profile ID %d.</info>", $profileId));
                $importModel = $this->importFactory->create()->setProfile($profile);
                // Import
                $importModel->cronImport();
                $output->writeln(sprintf('<info>Import for profile ID %d completed. Check "Execution Log" for detailed results.</info>', $profileId));
            } catch (\Exception $exception) {
                $output->writeln(sprintf("<error>Exception for profile ID %d: %s</error>", $profileId, $exception->getMessage()));
                continue;
            }
        }
        $output->writeln("<info>Finished command.</info>");
        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }
}
