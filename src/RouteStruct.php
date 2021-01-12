<?php


namespace PhpOne\LaravelAnnotation;


class RouteStruct
{
    public string $controller;
    public string $action;
    public string $uri;
    public string $method;

    public function generateRoute(): string
    {
        return "Route::".$this->method.'("'.$this->uri.'","'.$this->controller.'@'.$this->action.'");';
    }
}