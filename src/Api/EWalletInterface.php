<?php

namespace pulyavin\Payture\Api;

use pulyavin\Payture\Exceptions\PaytureException;

interface EWalletInterface
{
    /**
     * @param string $VWUserLgn
     * @param string $VWUserPsw
     * @param array $data
     *
     * @return array
     *
     * @throws PaytureException
     */
    public function GetList(string $VWUserLgn, string $VWUserPsw, $data = []): array;

    /**
     * @param string $VWUserLgn
     * @param string $VWUserPsw
     * @param string $cardId
     * @param string $orderId
     * @param int $amount
     * @param array $data
     *
     * @return array
     *
     * @throws PaytureException
     */
    public function Pay(
        string $VWUserLgn,
        string $VWUserPsw,
        string $cardId,
        string $orderId,
        int $amount,
        $data = []
    ): array;
}