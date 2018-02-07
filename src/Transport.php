<?php

namespace pulyavin\Payture;

use pulyavin\Payture\Exceptions\PaytureException;
use pulyavin\streams\Stream;

class Transport implements TransportInterface
{
    /**
     * @var XmlConverterInterface
     */
    private $xmlConverter;

    /**
     * Transport constructor.
     *
     * @param XmlConverterInterface|null $xmlConverter
     */
    public function __construct(XmlConverterInterface $xmlConverter = null)
    {
        if ($xmlConverter === null) {
            $xmlConverter = new XmlConverter;
        }

        $this->xmlConverter = $xmlConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function send(string $url, string $merchant, array $data): array
    {
        try {
            $stream = new Stream($url);

            $stream->pushPost([
                'VWID' => $merchant,
                'DATA' => Helper::stringify($data)
            ]);

            $stream->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $stream->setOpt(CURLOPT_RETURNTRANSFER, true);

            $response = $stream->exec();

            return $this->xmlConverter->convert($response);
        } catch (\Exception $e) {
            throw new PaytureException($e->getMessage());
        }
    }
}