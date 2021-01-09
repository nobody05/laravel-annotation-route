<?php


namespace PhpOne\LaravelAnnotation\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"METHOD"})
 *
 * Class PostMapping
 * @package PhpOne\Annotations
 */
class PostMapping extends Mapping
{
    public $method = "post";

}