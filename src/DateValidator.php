<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 17/03/2016
 * Time: 06:22
 */
class DateValidator implements DateValidatorInterface
{

    public function validate($date_str, DateFormatMatcherInterface $date_format_matcher)
    {
        if (! is_string($date_str)) {
            throw new InvalidDateFormatException('Date should be string. ' . gettype($date_str) . ' provided');
        }

        if (! preg_match($date_format_matcher->getMatcher(), $date_str)) {
            throw new InvalidDateFormatException('Date provided doesn\'t match the format expected (' . $date_format_matcher->getFormat() . ')');
        }

        if (false === strtotime($date_str)) {
            throw new InvalidDateException('Date provided is not a valid date');
        }

        return true;
    }
}