<?php

/*
 * Create a date object using given date string
 */
class DateFactory implements DateInterface
{
    /*
     * @var $instance
     */
    protected $instance = null;

    /*
     * @var $time
     */
    protected $time;

    /*
     * @var $date_str
     */
    private $date_str;

    /*
     * @var DateFormatMatcher $date_format
     */
    private $date_format;

    /**
     * DateFactory constructor.
     * @param $date_str
     * @param $date_format_str
     * @param DateValidatorInterface $validator
     */
    public function __construct($date_str, DateFormatMatcher $date_format, DateValidatorInterface $validator)
    {
        $this->date_str = $date_str;
        $this->date_format = $date_format;

        // validate input
        $validator->validate($this->date_str, $this->date_format);

        $this->time = strtotime($this->date_str);

        $this->year = date('Y', $this->time);
        $this->month = date('m', $this->time);
        $this->day = date('d', $this->time);
        $this->hour = date('H', $this->time);
        $this->minute = date('i', $this->time);
        $this->second = date('s', $this->time);
    }

    /**
     * @return bool|string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return bool|string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return bool|string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return int current timestamp
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return bool|string current date as string using Y-m-d format
     */
    public function getDate()
    {
        return date('Y-m-d', $this->time);
    }
}