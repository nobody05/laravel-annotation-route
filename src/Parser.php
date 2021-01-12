<?php


namespace PhpOne\LaravelAnnotation;


use PhpOne\LaravelAnnotation\Annotations\Controller;
use PhpOne\LaravelAnnotation\Annotations\GetMapping;
use PhpOne\LaravelAnnotation\Annotations\Group;
use PhpOne\LaravelAnnotation\Annotations\Mapping;
use PhpOne\LaravelAnnotation\Annotations\PostMapping;
use PhpOne\LaravelAnnotation\Exception\ControllerNotFoundException;
use PhpOne\LaravelAnnotation\RouteStruce\File;
use PhpOne\LaravelAnnotation\RouteStruce\Group as StruceGroup;
use PhpOne\LaravelAnnotation\RouteStruce\Route;

class Parser
{
    public $scanDirs;
    public $routeData;
    public $file;

    const ROUTEANNOTATIONS = [
        Group::class,
        Controller::class
    ];

    const MEDHODANNOTATIONS = [
        Mapping::class,
        PostMapping::class,
        GetMapping::class
    ];

    /**
     * your annotations dir
     * Parser constructor.
     * @param array $scanDirs
     */
    public function __construct(array $scanDirs)
    {
        $this->file = new File();
        $this->scanDirs = $scanDirs;
    }

    public function getRoute()
    {
        $scann = new Scanner($this->scanDirs);
        $classList = $scann->classList();

        $collecter = new Collecter($classList);
        $collecter->collecter();
        $classs = $collecter->getAnnotations();

        foreach ($classs as $className => $classInfo) {
            if (!empty($classInfo['c'])) {
                $routeStruce = new Route();
                foreach (self::ROUTEANNOTATIONS as $routeAnnotation) {
                    if (!empty($classInfo['c'][$routeAnnotation])) {
                        $controllerAnnotation = $classInfo['c'][$routeAnnotation];
                        if ($controllerAnnotation instanceof Controller) {
                            $routeStruce->controller = $classInfo['s'];
                            $routeStruce->uri .= rtrim($controllerAnnotation->prefix, "/"). "/";
                        } else if ($controllerAnnotation instanceof Group) {
                            $routeGroup = new StruceGroup();
                            $routeGroup->namespace = $controllerAnnotation->namespace;
                            $routeGroup->middlewares = $controllerAnnotation->middlewares;
                            $routeGroup->prefix = $controllerAnnotation->prefix;
                            $routeStruce->controller = $classInfo['s'];
                            $routeStruce->needIndent = true;
                            $routeGroup->routes[] = $routeStruce;
                        }
                    }
                }
            }

            $methods = $classInfo['m']??[];
            foreach ($methods as $methodName => $methdConfig) {
                foreach (self::MEDHODANNOTATIONS as $methodAnnotationClass) {
                    if (!empty($methdConfig[$methodAnnotationClass])) {
                        if (empty($routeStruce)) throw new ControllerNotFoundException();
                        /**
                         * @var $methodAnnotation Mapping
                         */
                        $methodAnnotation = $methdConfig[$methodAnnotationClass] ?? [];
                        $routeStruce->method = $methodAnnotation->method;
                        $routeStruce->action = $methodName;
                        $routeStruce->uri .= ltrim($methodAnnotation->path, "/");
                    }
                }
            }
            if (!empty($routeGroup)) {
                $this->file->appendContent($routeGroup->toString());
                $this->routeData[] = $routeGroup->toString();
            } else {
                $this->file->appendContent($routeStruce->toString());
                $this->routeData[] = $routeStruce->toString();
            }

        }

        return $this->routeData;
    }

    /**
     * your route file
     * @param $outFile
     * @param bool $force
     */
    public function writeRoute($outFile, $force = false)
    {
        $this->getRoute();
        $this->createFile($outFile);
        if ($force) {
            file_put_contents($outFile, $this->file->toString());
        } else {
            foreach ($this->routeData as $route) {
                file_put_contents($outFile, "\r\n". $route, FILE_APPEND);
                fwrite(STDOUT, sprintf("\r\n wirte route: %s success \r\n", $route));
            }
        }
    }

    public function createFile($file)
    {
        if (!file_exists(dirname($file))) {
            @mkdir(dirname($file), 0777, true);
        }
    }

}