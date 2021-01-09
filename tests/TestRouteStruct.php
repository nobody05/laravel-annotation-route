<?php


namespace PhpOne\Test;


use PhpOne\LaravelAnnotation\RouteStruct;
use PHPUnit\Framework\TestCase;

class TestRouteStruct extends TestCase
{
    public function testRoute()
    {
        $routeStruct = new RouteStruct();
        $routeStruct->controller = "CompanyController";
        $routeStruct->method = "get";
        $routeStruct->action = "info";
        $routeStruct->uri = "/api/company/info";

        var_dump($routeStruct->generateRoute());
    }

}