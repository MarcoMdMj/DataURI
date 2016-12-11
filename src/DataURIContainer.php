<?php

namespace MarcoMdMj\DataURI;

use MarcoMdMj\DataURI\Exceptions\DataURIException;

/**
 * DataURI Container.
 */
class DataURIContainer
{
    /**
     * Store the DataURI components.
     * @var array
     */
    private $components = [];

    /**
     * Plain text format of a DataURI.
     * @var string
     */
    private $format = 'data:type/subtype;encoding,content';

    /**
     * Init the container by receiving the set of components.
     * @param array $components.
     */
    public function __construct(array $components)
    {
        $this->components = $components;
    }

    /**
     * Get a specific component.
     * @param  string $component
     * @return string 
     */
    public function getComponent($component)
    {
        if (!array_key_exists($component, $this->components)) {
            throw new DataURIException("Requested component [$component] is not a valid Data URI component");
        }

        return $this->components[$component];
    }

    /**
     * Using the loaded components, generate a DataURI.
     * @return string
     */
    public function compose()
    {
        return strtr($this->format, $this->components);
    }

    /**
     * Return the type.
     * @return string
     */
    public function type()
    {
        return $this->getComponent('type');
    }

    /**
     * Return the subtype.
     * @return string
     */
    public function subtype()
    {
        return $this->getComponent('subtype');
    }

    /**
     * Return the mimetype (type/subtype).
     * @return string
     */
    public function mime()
    {
        return $this->getComponent('type') . '/' . $this->getComponent('subtype');
    }

    /**
     * Return the encoding.
     * @return string
     */
    public function encoding()
    {
        return $this->getComponent('encoding');
    }

    /**
     * Return the (encoded) content.
     * @return string
     */
    public function content()
    {
        return $this->getComponent('content');
    }

    /**
     * Return the decoded content.
     * @return string
     */
    public function content_decoded()
    {
        if (array_key_exists('content_decoded', $this->components)) {
            return $this->getComponent('content_decoded');
        }

        if (strcasecmp($this->encoding(), 'base64') == 0) {
            return $this->components['content_decoded'] = base64_decode($this->content());
        }

        return $this->components['content_decoded'] = $this->content();
    }
}