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

namespace Mageplaza\OrderExport\Block\Adminhtml\Profile\Edit;

use Magento\Backend\Block\Widget\Context;

/**
 * Class SaveOptions
 * @package Mageplaza\OrderExport\Block\Adminhtml\Profile\Edit
 */
class SaveOptions extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \Mageplaza\OrderExport\Block\Adminhtml\Profile
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id'           => 'save',
            'label'        => __('Save'),
            'class'        => 'save',
            'button_class' => '',
            'class_name'   => 'Magento\Backend\Block\Widget\Button\SplitButton',
            'options'      => $this->_getSaveProductButtonOptions(),

        ];
        $this->buttonList->add('save', $addButtonProps);

        return parent::_prepareLayout();
    }

    /**
     * Retrieve options for 'Save Profile' split button
     *
     * @return array
     */
    protected function _getSaveProductButtonOptions()
    {
        $splitButtonOptions = [
            'save'                   => [
                'label'          => __('Save'),
                'default'        => true,
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event'  => 'save',
                            'target' => '#edit_form',
                        ]
                    ]
                ]
            ],
            'save_generate'          => [
                'label'          => __('Save & Generate'),
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event'     => 'save',
                            'target'    => '#edit_form',
                            'eventData' => ['action' => ['args' => ['type' => 'save_generate']]],
                        ]
                    ]
                ]
            ],
            'save_generate_delivery' => [
                'label'          => __('Save/Generate & Delivery'),
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event'     => 'save',
                            'target'    => '#edit_form',
                            'eventData' => ['action' => ['args' => ['type' => 'save_generate_delivery']]],
                        ]
                    ]
                ]
            ]
        ];

        return $splitButtonOptions;
    }
}
