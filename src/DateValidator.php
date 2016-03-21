<?php

class DateValidator implements DateValidatorInterface
{
    /**
     * @param $date_str
     * @param DateFormatMatcherInterface $date_format_matcher
     * @return bool
     * @throws InvalidDateException
     * @throws InvalidDateFormatException
     */
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