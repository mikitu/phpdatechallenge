<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 17/03/2016
 * Time: 06:46
 */
class InvalidDateException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}