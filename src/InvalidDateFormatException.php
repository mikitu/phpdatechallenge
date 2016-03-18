<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 17/03/2016
 * Time: 06:34
 */
class InvalidDateFormatException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}