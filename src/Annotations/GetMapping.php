<?php


namespace PhpOne\LaravelAnnotation\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 *
 *
 * @Annotation
 * @Target({"METHOD"})
 *
 * Class GetMapping
 * @package PhpOne\Annotations
 */
class GetMapping extends Mapping
{
    public $method = "get";

}