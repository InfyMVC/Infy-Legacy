<?php
namespace Infy\Forms\Elements;

/**
 * Class TextInputElement
 * @package Infy\Forms\Elements
 */
class TextInputElement extends InfyFormElement
{
    /**
     * Instantiates a new TextInputElement
     *
     * @param string $name
     * @param string $value
     */
    function __construct($name, $value = "")
    {
        $this->type = "text";
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