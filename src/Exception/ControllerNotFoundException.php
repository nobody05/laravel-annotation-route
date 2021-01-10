<?php


namespace PhpOne\LaravelAnnotation\Exception;


use Throwable;

class ControllerNotFoundException extends \Exception
{
    public function __construct($message = "controller annotation not found ", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


}