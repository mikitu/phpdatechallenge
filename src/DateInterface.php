<?php

/**
 * Created by PhpStorm.
 * User: mbucse
 * Date: 17/03/2016
 * Time: 06:52
 */
interface DateInterface
{
    public function getYear();

    public function getMonth();

    public function getDay();

    public function getHour();

    public function getMinute();

    public function getSecond();

    public function getTime();

}