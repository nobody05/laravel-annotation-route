<?php


namespace PhpOne\Test;

use PhpOne\LaravelAnnotation\RouteStruce\Route;
use PHPUnit\Framework\TestCase;

class TestGroup extends TestCase
{
    const POSTS = [
        'get',
        'post'
    ];

    const CONTROLLERS = [
        'UserController',
        'CompanyController',
        'TestController'
    ];

    public function testGroup()
    {

        $group = new \PhpOne\LaravelAnnotation\RouteStruce\Group();
        $group->namespace = "/Api/Controllers";
        $group->prefix = "api/";
        $group->middlewares = ['user.auth'];

        for ($i=0; $i<3; $i++) {
            $route = new Route();
            $route->method = self::POSTS[mt_rand(0,1)];
            $route->controller = self::CONTROLLERS[mt_rand(0, 1)];
            $route->uri = "user/info";
            $route->action = "info";

            $group->routes[] = $route;
        }


        print_r($group->toString());



    }

}