<?php

namespace Infy\Forms\Elements;

/**
 * Class ButtonElement
 * @package Infy\Forms\Elements
 */
class ButtonElement extends InfyFormElement
{

    /**
     * Instantiates a new ButtonElement
     *
     * @param $value
     */
    function __construct($value)
    {
        $this->type = "button";
        $this->value = $value;
    }

    /**
     * @return string
     */
    function __toString()
    {
        $html = '<input type="' . $this->type . '" name="' . $this->name . '"';

        if ($this->value != "")
        {
            $html .= ' value="' . $this->value . '"';
        }

        if ($this->id != "")
        {
            $html .= ' id="' . $this->id . '"';
        }

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= " />";

        return $html;
    }
}
