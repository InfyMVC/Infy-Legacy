<?php
namespace Infy\Forms\Elements;

/**
 * Class CheckBoxElement
 * @package Infy\Forms\Elements
 */
class CheckBoxElement extends InfyFormElement
{
    /**
     * Holds if the checkbox is checked
     * @var bool
     */
    private $checked;

    /**
     * Instatiates a new CheckBoxElement
     *
     * @param      $name
     * @param bool $checked
     *
     * @internal param string $value
     */
    function __construct($name, $checked = false)
    {
        $this->type = "checkbox";
        $this->name = $name;
        $this->checked = $checked;
    }

    /**
     * Returns if the checkbox is checked
     * @return boolean
     */
    public function isChecked()
    {
        return $this->checked;
    }

    /**
     * Sets if the checkbox is checked
     *
     * @param boolean $checked
     *
     * @return $this
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
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

        $html .= ($this->checked ? " checked" : "");

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= " />";

        return $html;
    }
}