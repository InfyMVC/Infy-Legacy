<?php
namespace Infy\Forms\Elements;

/**
 * Class TextElement
 * @package Infy\Forms\Elements
 */
class TextElement extends InfyFormElement
{
    /**
     * Holds the tag for the element
     * @var string
     */
    private $tag = "";

    /**
     * Holds the text for the element
     * @var string
     */
    private $text = "";

    /**
     * Instantiates a new TextElement
     *
     * @param       $tag
     * @param array $text
     */
    function __construct($tag, $text)
    {
        $this->type = "textelement";
        $this->tag = $tag;
        $this->text = $text;
    }

    /**
     * Gets the tag for the element
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Sets the elementtag
     *
     * @param string $tag
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Gets the text for the element
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text for the element
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
     * @return string
     */
    function __toString()
    {
        $html = '<' . $this->tag;

        if ($this->id != "")
            $html .= ' id=".' . $this->id . '"';

        $html .= $this->getClassesString();

        $html .= $this->getDataAttributesString();

        $html .= '>' . $this->text . '</' . $this->tag . '>';

        return $html;
    }
}