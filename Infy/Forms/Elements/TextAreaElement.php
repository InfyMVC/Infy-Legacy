<?php
namespace Infy\Forms\Elements;

/**
 * Class TextAreaElement
 * @package Infy\Forms\Elements
 */
class TextAreaElement extends InfyFormElement
{
    /**
     * Specifies the visible width of a text area
     * @var int
     */
    private $cols = 20;

    /**
     * Specifies that a text area should be read-only
     * @var bool
     */
    private $readonly = false;

    /**
     * Specifies the visible number of lines in a text area
     * @var int
     */
    private $rows = 2;

    /**
     * Instantiates a new TextAreaElement
     *
     * @param        $name
     * @param string $value
     */
    function __construct($name, $value = "")
    {
        $this->type = "textarea";
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Gets the visible width
     * @return int
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * Sets the visible width
     *
     * @param int $cols
     *
     * @return $this
     */
    public function setCols($cols)
    {
        $this->cols = $cols;

        return $this;
    }

    /**
     * Gets if the textarea is readonly
     * @return boolean
     */
    public function isReadonly()
    {
        return $this->readonly;
    }

    /**
     * Sets if the textarea is readonly
     *
     * @param boolean $readonly
     *
     * @return $this
     */
    public function setReadonly($readonly)
    {
        $this->readonly = $readonly;

        return $this;
    }

    /**
     * Gets the visible number of lines
     * @return int
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Sets the visible number of lines
     *
     * @param int $rows
     *
     * @return $this
     */
    public function setRows($rows)
    {
        $this->rows = $rows;

        return $this;
    }

    function __toString()
    {
        $html = '<textarea';

        $html .= ' name="' . $this->name . '"';

        if ($this->id != "")
            $html .= ' id="' . $this->id . '"';

        $html .= ' cols="' . $this->cols . '"';

        $html .= ' rows="' . $this->rows . '"';

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= ($this->disabled ? ' disabled' : '');

        $html .= '>' . $this->value . '</textarea>';

        return $html;
    }
}