<?php

namespace MarcoMdMj\DataURI;

use MarcoMdMj\DataURI\Drivers\Decoder;
use MarcoMdMj\DataURI\Drivers\Encoder;
use MarcoMdMj\DataURI\Drivers\DriverInterface;

/**
* Data URI Manager
*/
class DataURIManager
{
    /**
     * DataURIContainer Instance
     * @var DataURIContainer
     */
    private $container;

    /**
     * Render the input and create a DataURIContainer. Cannot be called directly since
     * it is supposed to be an inmutable class, so one of the static accessors must
     * be used instead of.
     * @param DriverInterface
     */
    private function __construct(DriverInterface $driver)
    {
        $this->container = new DataURIContainer($driver->render());
    }

    /**
     * Return the DataURIContainer instance
     * @return DataURIContainer
     */
    public function container()
    {
        return $this->container;
    }

    /**
     * Instantiate the object by giving an instance of the Decoder driver. Then return
     * the resulting container.
     * @param  string $raw
     * @return DataURIContainer
     */
    public static function decode($raw)
    {
        $instance = new static(new Decoder($raw));

        return $instance->container();
    }

    /**
     * Instantiate the object by giving an instance of the Encoder driver. Then return
     * the resulting container.
     * @param  string $path
     * @return DataURIContainer
     * @param  [type]
     * @return [type]
     */
    public static function encode($path)
    {
        $instance = new static(new Encoder($path));

        return $instance->container();
    }
}