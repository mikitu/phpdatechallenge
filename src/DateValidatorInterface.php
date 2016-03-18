<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 17/03/2016
 * Time: 06:21
 */
interface DateValidatorInterface
{
    public function validate($date_str, DateFormatMatcherInterface $date_format_matcher);
}