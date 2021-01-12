<?php


namespace PhpOne\LaravelAnnotation\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"CLASS"})
 *
 * Class Group
 * @package PhpOne\LaravelAnnotation\Annotations
 */
class Group
{
    public string $middlewares;
    public string $namespace;
    public string $prefix;

    /**
     * @return mixed
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }


}