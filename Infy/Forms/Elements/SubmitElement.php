<?php
namespace Infy\Forms\Elements;

/**
 * Class SubmitElement
 * @package Infy\Forms\Elements
 */
class SubmitElement extends InfyFormElement
{
    /**
     * Instantiates a new SubmitElement
     *
     * @param $value
     */
    function __construct($value)
    {
        $this->type = "submit";
        $this->value = $value;
    }

    function __toString()
    {
        $html = '<input type="' . $this->type . '" name="' . $this->name . '"';

        if ($this->value != "")
            $html .= ' value="' . $this->value . '"';

        if ($this->id != "")
            $html .= ' id="' . $this->id . '"';

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= " />";

        return $html;
    }
}