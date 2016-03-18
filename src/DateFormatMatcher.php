<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 17/03/2016
 * Time: 07:10
 */
class DateFormatMatcher implements DateFormatMatcherInterface
{
    /**
     * @var
     */
    private $format;

    public function __construct($format)
    {
        $this->format = $format;
    }

    public function getMatcher()
    {
        return '#^(\d){4}/(\d){2}/(\d){2}$#';
    }

    public function getformat()
    {
        return $this->format;
    }
}