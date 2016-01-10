<?php

namespace Infy\Annotations;

class AnnotationReader
{
    private $method;
    private $annotations;

    function __construct(\ReflectionMethod $method)
    {
        $this->method = $method;
        $this->parseAnnotations();
    }

    public function getValue($parameter)
    {
        return array_key_exists($parameter, $this->annotations) ? $this->annotations[$parameter] : null;
    }

    private function getAnnotations()
    {
        $doc = $this->method->getDocComment();

        preg_match_all('#@(.*?)\n#s', $doc, $annotations);

        return $annotations[1];
    }

    private function parseAnnotations()
    {
        $annotationArray = $this->getAnnotations();

        $this->annotations = [];

        foreach ($annotationArray as $key => $value)
        {
            preg_match('/(?<key>.*): (?<value>.*)/', $value, $matches);
            $this->annotations[trim($matches["key"])] = trim($matches["value"]);
        }
    }
}