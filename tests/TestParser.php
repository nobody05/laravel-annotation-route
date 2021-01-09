<?php


namespace PhpOne\Test;


use PhpOne\LaravelAnnotation\Parser;
use PHPUnit\Framework\TestCase;

class TestParser extends TestCase
{
    public function testParser()
    {
        $parser = new Parser([__DIR__.'/Controller']);
        $parser->writeRoute(__DIR__.'/route/api.php');
    }

}