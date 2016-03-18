<?php

class MyDate
{
    public static function diff($start, $end, DateFormatMatcher $date_format = null)
    {
        return (new DateDiff($start, $end, $date_format))->getObject();
    }
}
