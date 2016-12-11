<?php

namespace MarcoMdMj\DataURI\Drivers;

use finfo;
use MarcoMdMj\DataURI\Exceptions\DataURIException;

/**
* Encoder driver.
*/
class Encoder implements DriverInterface
{
    private $path;

    /**
     * Init the encoder by passing the path of the file to be encoded.
     * @param string $raw
     */
    public function __construct($path)
    {
        $this->path = realpath($path) ?: realpath(base_path($path));

        if (!$this->path) {
            throw new DataURIException('The given file path [' . $path . '] does not exist.');
        }
    }

    /**
     * Generate the corresponding DataURI and return the components as an array.
     * @return array
     */
    public function render()
    {
        $raw = file_get_contents($this->path);
    
        $mimetype = (new finfo(FILEINFO_MIME_TYPE))->buffer($raw);
        list($type, $subtype) = explode('/', $mimetype);

        $encoding = 'base64';

        $content = base64_encode($raw);

        return compact('type', 'subtype', 'encoding', 'content');
    }
}