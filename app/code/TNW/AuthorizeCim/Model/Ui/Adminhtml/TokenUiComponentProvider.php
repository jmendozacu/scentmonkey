<?php
/**
 * Copyright © 2017 TechNWeb, Inc. All rights reserved.
 * See TNW_LICENSE.txt for license details.
 */
namespace TNW\AuthorizeCim\Model\Ui\Adminhtml;

use TNW\AuthorizeCim\Model\Ui\ConfigProvider;
use Magento\Vault\Api\Data\PaymentTokenInterface;
use Magento\Framework\View\Element\Template;
use Magento\Vault\Model\Ui\TokenUiComponentInterface;
use Magento\Vault\Model\Ui\TokenUiComponentProviderInterface;
use Magento\Vault\Model\Ui\TokenUiComponentInterfaceFactory;
use Magento\Framework\UrlInterface;

class TokenUiComponentProvider implements TokenUiComponentProviderInterface
{
    /** @var TokenUiComponentInterfaceFactory */
    private $componentFactory;

    /**
     * @param TokenUiComponentInterfaceFactory $componentFactory
     */
    public function __construct(
        TokenUiComponentInterfaceFactory $componentFactory
    ) {
        $this->componentFactory = $componentFactory;
    }

    /**
     * Get UI component for token
     * @param PaymentTokenInterface $paymentToken
     * @return TokenUiComponentInterface
     */
    public function getComponentForToken(PaymentTokenInterface $paymentToken)
    {
        $jsonDetails = json_decode(
            $paymentToken->getTokenDetails() ?: '{}',
            true
        );

        return $this->componentFactory->create([
            'config' => [
                'code' => ConfigProvider::VAULT_CODE,
                TokenUiComponentProviderInterface::COMPONENT_DETAILS => $jsonDetails,
                TokenUiComponentProviderInterface::COMPONENT_PUBLIC_HASH => $paymentToken->getPublicHash(),
                'template' => 'TNW_AuthorizeCim::form/vault.phtml'
            ],
            'name' => Template::class
        ]);
    }
}
