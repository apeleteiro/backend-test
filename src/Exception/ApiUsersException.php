<?php

namespace App\Exception;

class ApiUsersException extends \Exception
{
    protected $message = 'An error has occurred trying to get the API users';
}
