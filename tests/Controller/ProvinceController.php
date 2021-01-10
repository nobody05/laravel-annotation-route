<?php


namespace PhpOne\Test\Controller;

use PhpOne\LaravelAnnotation\Annotations\GetMapping;
use PhpOne\LaravelAnnotation\Annotations\Group;

/**
 * @Group(middlewares="user.auth")
 * Class ProvinceController
 * @package PhpOne\Test\Controller
 */
class ProvinceController
{
    /**
     * @GetMapping(path="info")
     */
    public function info()
    {

    }

}