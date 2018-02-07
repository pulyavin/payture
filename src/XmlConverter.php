<?php

namespace pulyavin\Payture;

use pulyavin\Payture\Exceptions\PaytureException;

class XmlConverter implements XmlConverterInterface
{
    /**
     * {@inheritdoc}
     */
    public function convert(string $xml): array
    {
        $xml = new \SimpleXMLIterator($xml);

        $resultObject = $this->nodeToArray($xml);

        // handle errors
        if (empty($resultObject['Success']) || $resultObject['Success'] == false) {
            $errorMessage = empty($resultObject['ErrCode']) ? "Error is undefined" : $resultObject['ErrCode'];

            throw new PaytureException($errorMessage);
        }

        if (!empty($resultObject['ErrCode'])) {
            throw new PaytureException($resultObject['ErrCode']);
        }

        return $resultObject;
    }

    /**
     * @param $XMLNode
     *
     * @return array
     */
    private function nodeToArray($XMLNode): array
    {
        $result = [];

        foreach ($XMLNode->attributes() as $k => $v) {
            $val = (string)$v;
            if ($val == "True" || $val == "False") $val = (bool)$val;
            $result[$k] = $val;
        }

        foreach ($XMLNode->children() as $chK => $chNode) {
            $result[$chK] = $this->nodeToArray($chNode);
        }

        return $result;
    }
}