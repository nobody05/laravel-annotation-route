<?php


namespace PhpOne\LaravelAnnotation\RouteStruce;

/**
 *
 * Route::get("api/info", "InfoController@info");
 * Class Route
 * @package PhpOne\LaravelAnnotation\RouteStruce
 */
class Route
{
    public $controller;
    public $action;
    public $uri;
    public $method;
    private $iPrefix = "Route::";
    private $iSuffix = ");";
    public $needIndent = false;

    public function toString()
    {
        return sprintf("\r\n%s%s%s('%s','%s@%s'%s",
            $this->needIndent?'    ':'',
            $this->iPrefix,
            $this->method,
            $this->uri,
            $this->controller,
            $this->method,
            $this->iSuffix
        );
    }

}