<?php

namespace pulyavin\Payture;

class Helper
{
    const API_PREFIX_EWALLET = 'vwapi';

    /**
     * @param string $url
     * @param string $method
     *
     * @return string
     */
    public static function getEWalletUrl(string $url, string $method): string
    {
        return sprintf(
            "%s/%s/%s",
            trim($url, "/"),
            self::API_PREFIX_EWALLET,
            $method
        );
    }

    /**
     * @param array $array
     * @param string $glue
     *
     * @return string
     */
    public static function stringify(array $array, string $glue = ';'): string
    {
        $mergedArray = [];

        foreach ($array as $k => $v) {
            $mergedArray[] = $k . "=" . $v;
        }

        return implode($glue, $mergedArray);
    }
}