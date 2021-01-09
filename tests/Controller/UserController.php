<?php


namespace PhpOne\Test\Controller;


use PhpOne\LaravelAnnotation\Annotations\Controller;
use PhpOne\LaravelAnnotation\Annotations\PostMapping;

/**
 * @Controller(prefix="api/user")
 * Class UserController
 * @package PhpOne\Test\Controller
 */
class UserController
{

    public function __construct()
    {

    }

    /**
     * @PostMapping(path="login")
     */
    public function login()
    {
       echo "Login";
    }


}