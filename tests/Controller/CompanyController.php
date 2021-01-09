<?php


namespace PhpOne\Test\Controller;


use PhpOne\LaravelAnnotation\Annotations\Controller;
use PhpOne\LaravelAnnotation\Annotations\GetMapping;

/**
 * @Controller(prefix="api/company")
 *
 * Class CompanyController
 * @package PhpOne\Test\Controller
 */
class CompanyController
{
    /**
     * @GetMapping(path="info")
     */
    public function info()
    {

    }

}