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

namespace Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;

/**
 * Class NewAction
 * @package Mageplaza\OrderExport\Controller\Adminhtml\ManageProfiles
 */
class NewAction extends Action
{
    /**
     * Redirect result factory
     *
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * constructor
     *
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;

        parent::__construct($context);
    }

    /**
     * forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');

        return $resultForward;
    }
}
