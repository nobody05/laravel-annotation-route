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
    public string $controller;
    public string $action;
    public string $uri;
    public string $method;
    private string $iPrefix = "Route::";
    private string $iSuffix = ");";
    public bool $needIndent = false;

    public function toString(): string
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