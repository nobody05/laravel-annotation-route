<?php


namespace PhpOne\LaravelAnnotation\Exception;


use Throwable;

class GroupNotFoundException extends \Exception
{
    public function __construct($message = "group not found ", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}