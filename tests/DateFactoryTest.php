<?php

class DateFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $date;

    public function tearDown()
    {
        Mockery::close();
    }

    public function setUp()
    {
        $dateFormatMatcherMock = \Mockery::mock('DateFormatMatcher', function($mock) {
            $mock->shouldReceive('getMatcher')
                ->andReturn('#^(\d){4}/(\d){2}/(\d){2}$#')
                ->shouldReceive('getFormat')
                ->andReturn('Y/m/d')
            ;
        });

        $dateValidatorMock = Mockery::mock('DateValidator');
        $dateValidatorMock->shouldReceive('validate')->andReturn(true);

        $this->date = new DateFactory('2016/03/15', $dateFormatMatcherMock, $dateValidatorMock);

    }

    public function testGetDate()
    {
        $this->assertEquals('2016-03-15', $this->date->getDate());
    }

    public function testGetYear()
    {
        $this->assertEquals('2016', $this->date->getYear());
    }

    public function testGetMonth()
    {
        $this->assertEquals('03', $this->date->getMonth());
    }

    public function testGetDay()
    {
        $this->assertEquals('15', $this->date->getDay());
    }

    public function testGetTime()
    {
        $this->assertEquals(strtotime('2016-03-15'), $this->date->getTime());
    }
}