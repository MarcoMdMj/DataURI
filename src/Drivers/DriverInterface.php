<?php

namespace MarcoMdMj\DataURI\Drivers;

/**
 * Driver interface.
 */
interface DriverInterface
{
    /**
     * Parse the input and return the resulting components.
     * @return array
     */
    public function render();
}