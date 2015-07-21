<?php

namespace Infy\Forms\Elements;

/**
 * Class InfyFormElement
 * @package Infy\Forms\Elements
 */
abstract class InfyFormElement
{

    /**
     * Initializes a FormElement
     *
     * @param       $name
     * @param array $classes
     */
    function __construct($name, $classes = array())
    {
        $this->name = $name;
        $this->classes = $classes;
    }

    /**
     * ID of the element
     * @var string
     */
    protected $id = "";

    /**
     * Holds all classes for the element
     * @var array
     */
    protected $classes = array();

    /**
     * Name of the element
     * @var string
     */
    protected $name = "";

    /**
     * Type of the element
     * @var string
     */
    protected $type = "";

    /**
     * Predefined value of the element
     * @var string
     */
    protected $value = "";

    /**
     * Sets if the element is disabled
     * @var bool
     */
    protected $disabled = false;

    /**
     * Holds all data attributes
     * @var array
     */
    protected $dataAttributes = array();

    /**
     * Returns the ID of the element
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the classes of the element
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Returns the name of the element
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the type of the element
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the default value of the element
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns if the element is disabled or not
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * Returns the data attributes
     * @return array
     */
    public function getDataAttributes()
    {
        return $this->dataAttributes;
    }

    /**
     * Sets the id of the element
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
     * Sets the type of the element
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the default value of the element
     *
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Sets if the element is disabled
     *
     * @param boolean $disabled
     *
     * @return $this
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Adds a class
     *
     * @param $className
     *
     * @return $this
     */
    public function addClass($className)
    {
        $this->classes[] = $className;

        return $this;
    }

    /**
     * Removes a class
     *
     * @param $className
     *
     * @return $this
     */
    public function removeClass($className)
    {
        if (array_key_exists($className, $this->classes))
            unset($this->classes[$className]);

        return $this;
    }

    /**
     * Removes all classes
     * @return $this
     */
    public function removeAllClasses()
    {
        $this->classes = array();

        return $this;
    }

    /**
     * Adds a data attribute
     *
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function addDataAttribute($name, $value)
    {
        $this->dataAttributes[$name] = $value;

        return $this;
    }

    /**
     * Removes a data attribute
     *
     * @param $name
     *
     * @return $this
     */
    public function removeDataAttribute($name)
    {
        if (array_key_exists($name, $this->dataAttributes))
        {
            unset($this->dataAttributes[$name]);
        }

        return $this;
    }

    /**
     * Removes all data attributes
     * @return $this
     */
    public function removeAllDataAttributes()
    {
        $this->dataAttributes = array();

        return $this;
    }

    abstract function __toString();

    /**
     * Gets a string from all classes
     * @return string
     */
    protected function getClassesString()
    {
        $html = "";

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

        return $html;
    }

    protected function getDataAttributesString()
    {
        $html = "";

        if (count($this->dataAttributes) != 0)
        {
            foreach ($this->dataAttributes as $key => $value)
            {
                $html .= ' data-' . $key . '="' . $value . '"';
            }
        }

        return $html;
    }
}
