<?php

namespace pulyavin\Payture;

class Configuration
{
    const TYPE_MERCHANT_ADD = 'add';
    const TYPE_MERCHANT_PAY = 'pay';

    const URL_SANDBOX = 'https://sandbox.payture.com';
    const URL_SECURE = 'https://secure.payture.com';

    /**
     * @var string
     */
    private $addMerchant;

    /**
     * @var string
     */
    private $payMerchant;

    /**
     * @var string
     */
    private $url;

    /**
     * Configuration constructor.
     *
     * @param string|null $addMerchant
     * @param string|null $payMerchant
     * @param bool $isSandbox
     */
    public function __construct(
        string $addMerchant = null,
        string $payMerchant = null,
        bool $isSandbox = false
    )
    {
        $this->addMerchant = $addMerchant;
        $this->payMerchant = $payMerchant;

        $this->url = ($isSandbox === true) ? self::URL_SANDBOX : self::URL_SECURE;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getMerchantByType(string $type): string
    {
        if ($type == self::TYPE_MERCHANT_ADD) {
            return $this->getAddMerchant();
        }

        return $this->getPayMerchant();
    }

    /**
     * @return string
     */
    public function getAddMerchant(): string
    {
        return $this->addMerchant;
    }

    /**
     * @return string
     */
    public function getPayMerchant(): string
    {
        return $this->payMerchant;
    }

    /**
     * @param string $url
     *
     * @return Configuration
     */
    public function setUrl(string $url): Configuration
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}