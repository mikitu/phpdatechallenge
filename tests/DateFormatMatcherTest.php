<?php

class DateFormatMatcherTest extends PHPUnit_Framework_TestCase
{
    protected $dateFormatMatcher;

    public function setUp()
    {
        $this->dateFormatMatcher = new DateFormatMatcher('Y/m/d');
    }

    public function testGetMatcher()
    {
        $this->assertEquals('#^(\d){4}/(\d){2}/(\d){2}$#', $this->dateFormatMatcher->getMatcher());
    }

    public function testGetFormat()
    {
        $this->assertEquals('Y/m/d', $this->dateFormatMatcher->getFormat());
    }
}