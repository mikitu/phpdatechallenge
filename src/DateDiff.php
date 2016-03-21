<?php

class DateDiff
{
    /*
     * @var $startDate
     */
    protected $startDate;

    /*
     * @var DateInterval $dateInterval
     */
    protected $dateInterval;

    /*
     * @var $endDate
     */
    protected $endDate;

    /**
     * DateDiff constructor.
     * @param $start
     * @param $end
     * @param DateFormatMatcher|null $date_format
     */
    public function __construct($start, $end, DateFormatMatcher $date_format = null)
    {
        if (null == $date_format) {
            $date_format = new DateFormatMatcher('YYYY/MM/DD');
        }

        $this->dateInterval = new MyDateInterval;
        $this->parseDates($start, $end, $date_format, new DateValidator());
        $this->process();
    }

    /**
     * @return MyDateInterval
     */
    public function getObject()
    {
        return $this->dateInterval;
    }

    /**
     * @param $start
     * @param $end
     * @param DateFormatMatcher $date_format
     * @param DateValidator $dateValidator
     */
    private function parseDates($start, $end, DateFormatMatcher $date_format, DateValidator $dateValidator)
    {
        $this->startDate = new DateFactory($start, $date_format, $dateValidator);
        $this->endDate = new DateFactory($end, $date_format, $dateValidator);
    }

    /**
     * calculate the difference between startDate and endDate
     * and populate the @var dateInterval object
     */
    private function process()
    {
        $day_range = $this->dateRange($this->startDate->getTime(), $this->endDate->getTime());
        $total_days = count($day_range);
        $total_days--;

        if ($this->startDate->getYear() == $this->endDate->getYear()) {
            $years = 0;
        } else  {
            $year_range = $this->dateRange($this->startDate->getTime(), $this->endDate->getTime(), '+1 year');
            $years = count($year_range);
            $years--;
        }

        if ($this->startDate->getMonth() == $this->endDate->getMonth()) {
            $months = 0;
        } else {
            $month_range = $this->dateRange($this->startDate->getTime(), $this->endDate->getTime(), '+1 month');
            $total_months = count($month_range);
            $months = $total_months - $years * 12;
        }

        if ($this->startDate->getDay() > $this->endDate->getDay()) {
            $months--;
        }
        if ($months < 0) {
            $months += 12;
            $years--;
        }
        $months_past = $years * 12 + $months;
        $start_day = strtotime('+' . ($months_past) . ' months', $this->startDate->getTime());

        if ($start_day > $this->endDate->getTime()) {
            $start_day = mktime(
                date('H'),
                date('i'),
                date('s'),
                $this->endDate->getMonth(),
                $this->startDate->getDay() - 1,
                $this->endDate->getYear());
        }
        $days = count($this->dateRange($start_day, $this->endDate->getTime()));
        $days--;
        $invert = $this->getInvert();

        $this->createObject($years, $months, $days, $total_days, $invert);
    }

    /**
     * check if is startDate > endDate
     * @return bool
     */
    private function getInvert()
    {
        $invert = false;
        $diff = $this->endDate->getTime() - $this->startDate->getTime();
        if ($diff < 0) {
            $invert = true;
        }
        return $invert;
    }

    /**
     * generate an array with dates created using given step
     * @param $start
     * @param $end
     * @param string $step
     * @return array
     */
    private function dateRange($start, $end, $step = '+1 day')
    {
        $current = $start;
        $last = $end;
        if ($start > $end) {
            $current = $end;
            $last = $start;
        }
        $dates = array();
        while ($current <= $last) {
            $dates[] = $current;
            $current = strtotime($step, $current);
        }
        return $dates;
    }

    /**
     * @param $years
     * @param $months
     * @param $days
     * @param $total_days
     * @param $invert
     */
    private function createObject($years, $months, $days, $total_days, $invert)
    {
        $this->dateInterval->years = $years;
        $this->dateInterval->months = $months;
        $this->dateInterval->days = $days;
        $this->dateInterval->total_days = $total_days;
        $this->dateInterval->invert = $invert;
    }
}