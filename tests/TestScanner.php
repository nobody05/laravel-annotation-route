<?php


namespace PhpOne\Test;


use PhpOne\LaravelAnnotation\Collecter;
use PhpOne\LaravelAnnotation\Parser;
use PhpOne\LaravelAnnotation\Scanner;
use PHPUnit\Framework\TestCase;

class TestScanner extends TestCase
{
    public function testClassList()
    {
//        $scann = new Scanner([__DIR__.'/Controller']);
//        $classList = $scann->classList();
//
//        $collecter = new Collecter($classList);
//        $collecter->collecter();
//        print_r($collecter->getAnnotations());

        $parser = new Parser([__DIR__.'/Controller']);
        $routes = $parser->getRoute();


        foreach ($routes as $route) {
            file_put_contents(__DIR__.'/route/api.php', "\r\n", FILE_APPEND);
            file_put_contents(__DIR__.'/route/api.php', $route, FILE_APPEND);
            file_put_contents(__DIR__.'/route/api.php', "\r\n", FILE_APPEND);
        }
    }

}