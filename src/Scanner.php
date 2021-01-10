<?php


namespace PhpOne\LaravelAnnotation;


use Composer\Autoload\ClassLoader;
use PhpOne\Test\Controller\UserController;
use Roave\BetterReflection\BetterReflection;
use Roave\BetterReflection\Reflector\ClassReflector;
use Roave\BetterReflection\SourceLocator\Type\AggregateSourceLocator;
use Roave\BetterReflection\SourceLocator\Type\ComposerSourceLocator;
use Roave\BetterReflection\SourceLocator\Type\DirectoriesSourceLocator;

class Scanner
{
    public array $scanDirs = [];

    public function __construct($scanDirs = [])
    {
        $this->scanDirs = $scanDirs ?? [dirname(dirname(__DIR__)).'/app/Http/Controllers'];
    }

    /**
     * @return \Roave\BetterReflection\Reflection\ReflectionClass[]
     */
    public function classList()
    {
        $locators[] = new DirectoriesSourceLocator(
            $this->scanDirs,
            (new BetterReflection())->astLocator()
        );
        if (file_exists(dirname(dirname(dirname(__DIR__))).'/autoload.php')) {
            $classLoader = require dirname(dirname(dirname(__DIR__))).'/autoload.php';
            $locators[] = new ComposerSourceLocator(
                $classLoader,
                (new BetterReflection())->astLocator()
            );
        }

        $classReflector = new ClassReflector(new AggregateSourceLocator($locators));

        return $classReflector->getAllClasses();
    }


}