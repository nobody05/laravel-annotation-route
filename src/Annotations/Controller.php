<?php


namespace PhpOne\LaravelAnnotation\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 *
 * @Annotation
 * @Target({"CLASS"})
 *
 * Class Controller
 * @package PhpOne\Annotations
 */
class Controller
{
    public $prefix;

}