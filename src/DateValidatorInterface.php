<?php

interface DateValidatorInterface
{
    public function validate($date_str, DateFormatMatcherInterface $date_format_matcher);
}