<?php
namespace Infy\Forms\Elements;

/**
 * Class ImageInputElement
 * @package Infy\Forms\Elements
 */
class ImageInputElement extends InfyFormElement
{
    /**
     * Holds the source image
     * @var string
     */
    private $source = "";

    /**
     * Holds the alternative text
     * @var string
     */
    private $alt = "";

    /**
     * Instantiates a new ImageInputElement
     *
     * @param        $name
     * @param array  $source
     * @param string $alt
     */
    function __construct($name, $source, $alt = "")
    {
        $this->type = "image";
        $this->name = $name;
        $this->source = $source;
        $this->alt = $alt;
    }

    /**
     * Returns the source for the image
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets the source for the image
     *
     * @param string $source
     *
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Returns the alternativ text
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Sets the alternative text
     *
     * @param string $alt
     *
     * @return $this
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    function __toString()
    {
        $html = '<input type="' . $this->type . '" name="' . $this->name . '"';

        if ($this->source != "")
            $html .= ' src="' . $this->source . '"';

        if ($this->id != "")
            $html .= ' id="' . $this->id . '"';

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= " />";

        return $html;
    }
}