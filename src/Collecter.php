<?php


namespace PhpOne\LaravelAnnotation;


use Doctrine\Common\Annotations\AnnotationReader;
use Roave\BetterReflection\Reflection\Adapter\ReflectionClass;
use Roave\BetterReflection\Reflection\Adapter\ReflectionMethod;
use Roave\BetterReflection\Reflection\Adapter\ReflectionProperty;

class Collecter
{
    public $container;
    public $classList;

    public function __construct($classList)
    {
        $this->classList = $classList;
    }

    public function addClassNamespaces($className, $classShortName, $namespaceName)
    {
        $this->container[$className]["n"] = $namespaceName;
        $this->container[$className]["s"] = $classShortName;
    }

    public function addClassAnnotations($className, $annotation, $value)
    {
        $this->container[$className]["c"][$annotation] = $value;
    }

    public function addMethodAnnotations($className, $methodName, $annotation, $value)
    {
        $this->container[$className]["m"][$methodName][$annotation] = $value;
    }

    public function addPropertyAnnotations($className, $propertyName, $annotation, $value)
    {
        $this->container[$className]["p"][$propertyName][$annotation] = $value;
    }

    public function getClassAnnotations($className)
    {
        return $this->container[$className]??[];
    }

    public function getAnnotations()
    {
        return $this->container;
    }

    /**
     * @throws \ReflectionException
     */
    public function collecter()
    {
        $annotationReader = new AnnotationReader();

        /**
         * @var $class \Roave\BetterReflection\Reflection\ReflectionClass
         */
        foreach ($this->classList as $class) {
            $classAnnotations = $annotationReader->getClassAnnotations(new ReflectionClass($class));

            foreach ($classAnnotations as $classAnnotation) {
                $this->addClassAnnotations($class->getName(), get_class($classAnnotation), $classAnnotation);
                $this->addClassNamespaces($class->getName(), $class->getShortName(), $class->getNamespaceName());
                $methods = $class->getMethods();
                foreach ($methods as $method) {
                    $methodAnnotations = $annotationReader->getMethodAnnotations(new ReflectionMethod($method));

                    foreach ($methodAnnotations as $methodAnnotation) {
                        $this->addMethodAnnotations($class->getName(), $method->getName(), get_class($methodAnnotation), $methodAnnotation);
                    }
                }

                $properties = $class->getProperties();
                foreach ($properties as $property) {
                    $propertyAnnotations = $annotationReader->getPropertyAnnotations(new ReflectionProperty($property));

                    foreach ($propertyAnnotations as $propertyAnnotation) {
                        $this->addPropertyAnnotations($class->getName(), $property->getName(), get_class($propertyAnnotation), $propertyAnnotation);
                    }
                }

            }

        }

    }



}