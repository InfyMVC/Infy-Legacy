<?php

namespace Infy\Forms\Elements;

/**
 * Class ResetElement
 * @package Infy\Forms\Elements
 */
class ResetElement extends InfyFormElement
{

    /**
     * Instantiates a new ResetElement
     *
     * @param $value
     */
    function __construct($value)
    {
        $this->type = "reset";
        $this->value = $value;
    }

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
