<?php

namespace Infy\Forms\Elements;

/**
 * Class PasswordInputElement
 * @package Infy\Forms\Elements
 */
class PasswordInputElement extends InfyFormElement
{

    /**
     * @param string $name
     * @param string $value
     */
    function __construct($name, $value = "")
    {
        $this->type = "password";
        $this->name = $name;
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
