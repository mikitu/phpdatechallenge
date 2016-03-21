<?php

class MyDate
{
    /**
     * @param $start
     * @param $end
     * @param DateFormatMatcher|null $date_format
     * @return MyDateInterval
     */
    public static function diff($start, $end, DateFormatMatcher $date_format = null)
    {
        return (new DateDiff($start, $end, $date_format))->getObject();
    }
}
