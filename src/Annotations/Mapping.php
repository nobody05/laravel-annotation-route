<?php


namespace PhpOne\LaravelAnnotation\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"METHOD"})
 *
 * Class Mapping
 * @package PhpOne\Annotations
 */
abstract class Mapping
{
    public string $path;
    public string $method;

}