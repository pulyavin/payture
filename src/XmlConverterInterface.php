<?php

namespace pulyavin\Payture;

interface XmlConverterInterface
{
    /**
     * @param string $xml
     *
     * @return array
     */
    public function convert(string $xml): array;
}