<?php
namespace Infy\Forms\Elements;

/**
 * Class OptionElement
 * @package Infy\Forms\Elements
 */
class OptionElement extends InfyFormElement
{
    /**
     * Text of the option
     * @var string
     */
    private $text = "";

    /**
     * @var bool
     */
    private $selected = false;

    function __construct($value, $text)
    {
        $this->value = $value;
        $this->text = $text;
    }

    /**
     * Returns the text
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text of the option
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Returns if the option is currently selected
     * @return boolean
     */
    public function isSelected()
    {
        return $this->selected;
    }

    /**
     * Sets if the option is selected
     *
     * @param boolean $selected
     *
     * @return $this
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return '<option value="' . $this->value . '"' . ($this->selected ? " selected" : "") . ($this->disabled ? ' disabled' : '') . '>' . $this->text . '</option>';
    }
}