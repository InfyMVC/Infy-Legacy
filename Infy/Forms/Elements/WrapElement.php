<?php
namespace Infy\Forms\Elements;

/**
 * Class WrapElement
 * @package Infy\Forms\Elements
 */
class WrapElement extends InfyFormElement
{
    /**
     * Contains the tag of the element
     * @var string
     */
    private $tag = "";

    /**
     * @var array
     */
    private $elements = array();

    /**
     * Instantiates a new WrapElement
     *
     * @param $tag
     */
    function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    function __toString()
    {
        if ($this->tag == "")
            return "";

        $html = '<' . $this->tag . '>';

        foreach ($this->elements as $key)
            $html .= $key;

        $html .= '</' . $this->tag . '>';
        
        return $html;
    }
}
