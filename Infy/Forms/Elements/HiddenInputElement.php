<?php

namespace Infy\Forms\Elements;

/**
 * Class HiddenInputElement
 * @package Infy\Forms\Elements
 */
class HiddenInputElement extends InfyFormElement
{

    /**
     * Instantiates a new HiddenInputElement
     *
     * @param        $name
     * @param string $value
     */
    function __construct($name, $value = "")
    {
        $this->type = "hidden";
        $this->name = $name;
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
