<?php

namespace Infy\Forms\Elements;

/**
 * Class SelectInputElement
 * @package Infy\Forms\Elements
 */
class SelectInputElement extends InfyFormElement
{

    /**
     * Holds all options from the select element
     * @var array
     */
    private $options = array();

    /**
     * Sets if the user can select more than one answer
     * @var bool
     */
    private $multiple = false;

    /**
     * Size of visible elements
     * @var int
     */
    private $size = 4;

    /**
     * Instantiates a new SelectInputElement
     *
     * @param $name
     */
    function __construct($name)
    {
        $this->type = "select";
        $this->name = $name;
    }

    /**
     * Gets all options
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Adds an option
     *
     * @param $option
     *
     * @return $this
     */
    public function addOption($option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Removes a specifig option
     *
     * @param $option
     *
     * @return $this
     */
    public function removeOption($option)
    {
        if (array_key_exists($option, $this->options))
        {
            unset($this->options[$option]);
        }

        return $this;
    }

    /**
     * Removes all options
     * @return $this
     */
    public function removeAllOptions()
    {
        $this->options = array();

        return $this;
    }

    /**
     * Gets if the user can select multiple options
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * Sets if the user can select multiple options
     *
     * @param boolean $multiple
     *
     * @return $this
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Gets the size of visible elements
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size of visible elements
     *
     * @param int $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        $html = '<select';

        $html .= ' name="' . $this->name . '"';

        if ($this->id != "")
        {
            $html .= ' id="' . $this->id . '"';
        }

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= ($this->multiple ? "  multiple" : "");

        $html .= ' size="' . $this->size . '"';

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= '>';

        foreach ($this->options as $key)
        {
            $html .= $key;
        }

        $html .= '</select>';

        return $html;
    }
}
