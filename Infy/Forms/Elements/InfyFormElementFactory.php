<?php
namespace Infy\Forms\Elements;

/**
 * Class InfyFormElementFactory
 * @package Infy\Forms\Elements
 */
class InfyFormElementFactory
{
    /**
     * Gets a new ButtonElement
     *
     * @param string $value
     *
     * @return ButtonElement
     */
    public static function getNewButtonElement($value)
    {
        return new ButtonElement($value);
    }

    /**
     * Gets a new CheckBoxElement
     *
     * @param string $name
     * @param bool   $checked
     *
     * @return CheckBoxElement
     * @internal param string $value
     */
    public static function getNewCheckBoxElement($name, $checked = false)
    {
        return new CheckBoxElement($name, $checked);
    }

    /**
     * Gets a new FileInputElement
     *
     * @param string $name
     *
     * @return FileInputElement
     */
    public static function getNewFileInputElement($name)
    {
        return new FileInputElement($name);
    }

    /**
     * Gets a new HiddenInputElement
     *
     * @param string $name
     * @param string $value
     *
     * @return HiddenInputElement
     */
    public static function getNewHiddenInputElement($name, $value = "")
    {
        return new HiddenInputElement($name, $value);
    }

    /**
     * Gets a new ImageInputElement
     *
     * @param string $name
     * @param string $source
     * @param string $alt
     *
     * @return ImageInputElement
     */
    public static function getNewImageInputElement($name, $source, $alt = "")
    {
        return new ImageInputElement($name, $source, $alt);
    }

    /**
     * Gets a new OptionElement
     *
     * @param string $value
     * @param string $text
     *
     * @return OptionElement
     */
    public static function getNewOptionElement($value, $text)
    {
        return new OptionElement($value, $text);
    }

    /**
     * Gets a new PasswordInputElement
     *
     * @param string $name
     *
     * @return PasswordInputElement
     */
    public static function getNewPassworInputElement($name)
    {
        return new PasswordInputElement($name);
    }

    /**
     * Gets a new RadioElement
     *
     * @param string $name
     * @param bool   $checked
     *
     * @return RadioElement
     */
    public static function getNewRadioElement($name, $checked = false)
    {
        return new RadioElement($name, $checked);
    }

    /**
     * Gets a new ResetElement
     *
     * @param string $value
     *
     * @return ResetElement
     */
    public static function getNewResetElement($value)
    {
        return new ResetElement($value);
    }

    /**
     * Gets a new SelectInputElement
     *
     * @param string $name
     *
     * @return SelectInputElement
     */
    public static function getNewSelectInputElement($name)
    {
        return new SelectInputElement($name);
    }

    /**
     * Gets a new SubmitElement
     *
     * @param string $value
     *
     * @return SubmitElement
     */
    public static function getNewSubmitElement($value)
    {
        return new SubmitElement($value);
    }

    /**
     * Gets a new TextAreaElement
     *
     * @param string $name
     * @param string $value
     *
     * @return TextAreaElement
     */
    public static function getNewTextAreaElement($name, $value = "")
    {
        return new TextAreaElement($name, $value);
    }

    /**
     * Gets a new TextElement
     *
     * @param string $tag
     * @param string $text
     *
     * @return TextElement
     */
    public static function getNewTextElement($tag, $text)
    {
        return new TextElement($tag, $text);
    }

    /**
     * Gets a new TextInputElement
     *
     * @param string $name
     *
     * @return TextInputElement
     */
    public static function getNewTextInputElement($name)
    {
        return new TextInputElement($name);
    }

    /**
     * Gets a new WrapElement
     *
     * @param $tag
     *
     * @return WrapElement
     */
    public static function getNewWrapElement($tag)
    {
        return new WrapElement($tag);
    }
}