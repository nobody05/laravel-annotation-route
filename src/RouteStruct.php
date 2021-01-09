<?php


namespace PhpOne\LaravelAnnotation;


class RouteStruct
{
    public $controller;
    public $action;
    public $uri;
    public $method;

    public function generateRoute()
    {
        return "Route::".$this->method.'("'.$this->uri.'","'.$this->controller.'@'.$this->action.'");';
    }
}