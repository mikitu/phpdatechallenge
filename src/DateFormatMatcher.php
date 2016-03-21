<?php

/*
 * create a regexp format matcher
 */
class DateFormatMatcher implements DateFormatMatcherInterface
{
    /**
     * @var
     */
    private $format;

    /**
     * DateFormatMatcher constructor.
     * @param $format
     */
    public function __construct($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getMatcher()
    {
        return '#^(\d){4}/(\d){2}/(\d){2}$#';
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }
}