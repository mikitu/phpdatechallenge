<?php

class DateDiff
{
    protected $startDate;
    protected $endDate;

    public function __construct($start, $end, DateFormatMatcher $date_format = null)
    {
        var_dump("StartDate: " . $start, "Enddate: " . $end);
        if (null == $date_format) {
            $date_format = new DateFormatMatcher('YYYY/MM/DD');
        }

        $this->dateInterval = new MyDateInterval;
        $this->parseDates($start, $end, $date_format, new DateValidator());
        $this->process();
    }

    public function getObject()
    {
        return $this->dateInterval;
    }

    private function parseDates($start, $end, DateFormatMatcher $date_format, DateValidator $dateValidator)
    {
        $this->startDate = new DateFactory($start, $date_format, $dateValidator);
        $this->endDate = new DateFactory($end, $date_format, $dateValidator);
    }

    private function process()
    {
        $this->getInvert();
        $day_range = $this->dateRange($this->startDate->getTime(), $this->endDate->getTime());
        $month_range = $this->dateRange($this->startDate->getTime(), $this->endDate->getTime(), '+1 month');
        $year_range = $this->dateRange($this->startDate->getTime(), $this->endDate->getTime(), '+1 year');

        $years = count($year_range);
        if ($this->startDate->getYear() == $this->endDate->getYear()) {
            $years = 0;
        }

        $total_months = count($month_range);
        $total_days = count($day_range);
        $months = $total_months - $years * 12;

        if ($months < 0) {
            $months += 12;
            $years--;
        }
        $months_past = $years * 12 + $months;

        $start_day = strtotime('+' . ($months_past) . ' months', $this->startDate->getTime());
        if ($start_day > $this->endDate->getTime()) {
            $start_day = strtotime(date('Y-m-01', $start_day));
        }
        $days = count($this->dateRange($start_day, $this->endDate->getTime()));
        var_dump("Date: " . date('d/m/Y', $start_day));
        var_dump("Days: " . $days);

//        if ($days < 0) {
//            $days += 1;
//            $months--;
//        }
        var_dump("Total days: " . $total_days);
        $invert = $this->getInvert();

        $this->createObject($years, $months, $days, $total_days, $invert);
        print_r($this->getObject());

    }
    private function getInvert()
    {
        $invert = false;
        $diff = $this->endDate->getTime() - $this->startDate->getTime();
        if ($diff < 0) {
            $invert = true;
        }
        return $invert;
    }
    private function dateRange($start, $end, $step = '+1 day')
    {
        $current = $start;
        $last = $end;
        if ($start > $end) {
            $current = $end;
            $last = $start;
        }
        $dates = array();
        while ($current < $last) {
            $dates[] = $current;
//            var_dump("D: " . date("Y-m-d", $current));
            $current = strtotime($step, $current);
        }
        return $dates;
    }

    private function createObject($years, $months, $days, $total_days, $invert)
    {
        $this->dateInterval->years = $years;
        $this->dateInterval->months = $months;
        $this->dateInterval->days = $days;
        $this->dateInterval->total_days = $total_days;
        $this->dateInterval->invert = $invert;
    }

}