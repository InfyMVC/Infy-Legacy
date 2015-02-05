<?php
namespace Infy\Forms;

use Infy\Forms\Elements\InfyFormElementFactory;
use Infy\Infy;

class InfyFormGenerator
{
    /**
     * Contains the method for the form
     * @var string
     */
    private $method = "";

    /**
     * Contains the destination of the form
     * @var string
     */
    private $action = "";

    /**
     * Name of the form
     * @var string
     */
    private $name = "";

    /**
     * ID of the form
     * @var string
     */
    private $id = "";

    /**
     * CSS classes for the form
     * @var array
     */
    private $classes = array();

    /**
     * Holder for all elements in the form
     * @var array
     */
    private $formelements = array();

    /**
     * Holds the enctype of the form
     * @var string
     */
    private $encType = "";

    /**
     * @param string $method   Method for the form
     * @param string $action   Sets the action for the form
     * @param bool   $addToken Add a CSRF token when action is POST
     * @param string $encType  Enctype of the form
     */
    function __construct($method, $action, $addToken = true, $encType = "application/x-www-form-urlencoded")
    {
        if (strtoupper($method) == "POST" && $addToken)
            $this->formelements[] = InfyFormElementFactory::getNewHiddenInputElement("csrf", Infy::Security()->getCSRF()->generateToken());

        $this->method = $method;
        $this->action = $action;
        $this->encType = $encType;
    }

    /**
     * Sets the name for the form
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Sets the id for the form
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Adds an element to the form
     *
     * @param $element
     *
     * @return $this
     */
    public function addElement($element)
    {
        $this->formelements[] = $element;

        return $this;
    }

    /**
     * Generates valid html for the form
     * @return string
     */
    public function generate()
    {
        $html = '<form';
        $html .= ' action="' . $this->action . '"';
        $html .= ' method="' . $this->method . '"';
        $html .= ' enctype="' . $this->encType . '"';

        if ($this->name != "")
            $html .= ' name="' . $this->name . '"';

        if ($this->id != "")
            $html .= ' id="' . $this->id . '"';

        if (count($this->classes) != 0)
        {
            $html .= ' class="';
            $first = true;

            foreach ($this->classes as $class)
            {
                if ($first)
                {
                    $html .= $class;
                    $first = false;
                }
                else
                {
                    $html .= ' ' . $class;
                }
            }

            $html .= '"';
        }

        $html .= '>';

        foreach ($this->formelements as $element)
        {
            $html .= $element->__toString();
        }

        $html .= '</form>';

        return $html;
    }
}