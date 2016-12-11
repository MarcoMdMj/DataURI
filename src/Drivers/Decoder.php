<?php

namespace MarcoMdMj\DataURI\Drivers;

use MarcoMdMj\DataURI\Exceptions\DataURIException;

/**
 * Decoder driver.
 */
class Decoder implements DriverInterface
{
    /**
     * Contains the raw input to be decoded.
     * @var string
     */
    private $raw;

    /**
     * Regular expression corresponding to a standard DataURI.
     * @var string
     */
    private $format = "#^data:([^/]+)/([^;]+);([^,]+),(.+)#s";

    /**
     * Init the decoder by passing the raw input to be decoded.
     * @param string $raw
     */
    public function __construct($raw)
    {
        $this->raw = $raw;
    }

    /**
     * Render the raw DataURI and return the components as an array.
     * @return array
     */
    public function render() 
    {
        return $this->getDataURIComponents($this->raw);
    }

    /**
     * Parse the raw $dataURI and return its components.
     * @param  string $dataURI
     * @throws DataURIException
     * @return array
     */
    private function getDataURIComponents($dataURI)
    {
        preg_match($this->format, $dataURI, $matches);

        if (count($matches) <> 5) {
            throw new DataURIException("The given data URI has an invalid format. (Data URI: $dataURI)");
        }

        return [
            'type' => $matches[1],
            'subtype' => $matches[2],
            'encoding' => $matches[3],
            'content' => $matches[4]
        ];
    }
}