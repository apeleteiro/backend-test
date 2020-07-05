<?php

namespace App\Exception;

class ApiStatsException extends \Exception
{
    protected $message = 'An error has occurred trying to get the API stats';
}
