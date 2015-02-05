<?php
namespace Infy\Forms\Elements;

/**
 * Class FileInputElement
 * @package Infy\Forms\Elements
 */
class FileInputElement extends InfyFormElement
{
    /**
     * Instantiates a new FileInputElement
     *
     * @param $name
     */
    function __construct($name)
    {
        $this->type = "file";
        $this->name = $name;
    }

    function __toString()
    {
        $html = '<input type="' . $this->type . '" name="' . $this->name . '"';

        if ($this->id != "")
            $html .= ' id="' . $this->id . '"';

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= " />";

        return $html;
    }
}