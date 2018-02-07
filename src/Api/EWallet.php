<?php

namespace pulyavin\Payture\Api;

use pulyavin\Payture\Configuration;
use pulyavin\Payture\Helper;
use pulyavin\Payture\Transport;
use pulyavin\Payture\TransportInterface;

class EWallet implements EWalletInterface
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var TransportInterface
     */
    private $transport;

    /**
     * EWallet constructor.
     *
     * @param Configuration $configuration
     * @param TransportInterface|null $transport
     */
    public function __construct(
        Configuration $configuration,
        TransportInterface $transport = null
    )
    {
        $this->configuration = $configuration;

        if ($transport === null) {
            $transport = new Transport();
        }

        $this->transport = $transport;
    }

    /**
     * {@inheritdoc}
     */
    public function GetList(string $VWUserLgn, string $VWUserPsw, $data = []): array
    {
        $params = array_merge([
            "VWUserLgn" => $VWUserLgn,
            "VWUserPsw" => $VWUserPsw,
        ], $data);

        $url = Helper::getEWalletUrl($this->configuration->getUrl(), 'GetList');

        return $this->transport->send(
            $url,
            $this->configuration->getMerchantByType(Configuration::TYPE_MERCHANT_ADD),
            $params
        );
    }

    /**
     * {@inheritdoc}
     */
    public function Pay(
        string $VWUserLgn,
        string $VWUserPsw,
        string $cardId,
        string $orderId,
        int $amount,
        $data = []
    ): array
    {
        $params = array_merge([
            "VWUserLgn" => $VWUserLgn,
            "VWUserPsw" => $VWUserPsw,
            "CardId" => $cardId,
            "OrderId" => $orderId,
            "Amount" => $amount,
        ], $data);

        $url = Helper::getEWalletUrl($this->configuration->getUrl(), 'Pay');

        return $this->transport->send(
            $url,
            $this->configuration->getMerchantByType(Configuration::TYPE_MERCHANT_PAY),
            $params
        );
    }
}