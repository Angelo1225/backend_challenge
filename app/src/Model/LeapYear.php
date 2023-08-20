<?php

namespace Crimsoncircle\Model;

class LeapYear
{
    public function isLeapYear(int $year): bool
    {
        //TODO: Logic must be implemented to calculate if a year is a leap year
        return (date('L', strtotime(strval( empty($year) ? date("Y") . "-01-01" : "$year-01-01" ) )) == 1 ) ? true : false;
    }
}