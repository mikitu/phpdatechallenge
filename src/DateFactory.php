<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 16/03/2016
 * Time: 22:17
 */
class DateFactory implements DateInterface
{
    protected $instance = null;
    protected $time;

    private $date_str;
    private $date_format_str  = 'YYYY/MM/DD';

    public function __construct($date_str, $date_format_str, DateValidatorInterface $validator)
    {
        $this->date_str = $date_str;
        $this->date_format_str = $date_format_str;

        $validator->validate($this->date_str, $this->date_format_str);
        $this->time = strtotime($this->date_str);
        $this->year = date('Y', $this->time);
        $this->month = date('m', $this->time);
        $this->day = date('d', $this->time);
        $this->hour = date('H', $this->time);
        $this->minute = date('i', $this->time);
        $this->second = date('s', $this->time);
    }

    public function isLeapYear($year)
    {
        return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)));
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function getMinute()
    {
        return $this->minute;
    }

    public function getSecond()
    {
        return $this->second;
    }

    public function getTime()
    {
        return $this->time;
    }
    public function getDate()
    {
        return date('Y-m-d', $this->time);
    }
}