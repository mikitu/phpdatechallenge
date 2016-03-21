<?php

class DateValidatorTest extends PHPUnit_Framework_TestCase
{
    protected $dateFormatMatcherMock;
    protected $validator;
    protected $dateFormatMatcherWrongMock;

    public function tearDown()
    {
        Mockery::close();
    }

    public function setUp()
    {
        $this->dateFormatMatcherMock = \Mockery::mock('DateFormatMatcher', function($mock) {
            $mock->shouldReceive('getMatcher')
                ->andReturn('#^(\d){4}/(\d){2}/(\d){2}$#')
                ->shouldReceive('getFormat')
                ->andReturn('Y/m/d')
            ;
        });
        $this->dateFormatMatcherWrongMock = \Mockery::mock('DateFormatMatcher', function($mock) {
            $mock->shouldReceive('getMatcher')
                ->andReturn('/^\d+$/')
                ->shouldReceive('getFormat')
                ->andReturn('Y/m/d')
            ;
        });
        $this->validator = new DateValidator;
    }

    /**
     * @expectedException     InvalidDateFormatException
     */
    public function testThrow_an_exception_if_date_is_not_string()
    {
        $this->validator->validate(1985, $this->dateFormatMatcherMock);
    }
    /**
     * @test
     * @expectedException     InvalidDateFormatException
     */
    public function throw_an_exception_if_date_is_in_wrong_format()
    {
        $this->validator->validate('2016/03/15', $this->dateFormatMatcherWrongMock);
    }

    /**
     * @test
     * @expectedException     InvalidDateException
     */
    public function throw_an_exception_if_date_is_invalid()
    {
        $this->validator->validate('2015/80/00', $this->dateFormatMatcherMock);
    }
    /**
     * @test
     */
    public function return_true_if_date_is_valid()
    {
        $this->validator->validate('2015/01/01', $this->dateFormatMatcherMock);
    }
}