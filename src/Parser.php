<?php


namespace PhpOne\LaravelAnnotation;


use PhpOne\LaravelAnnotation\Annotations\Controller;
use PhpOne\LaravelAnnotation\Annotations\GetMapping;
use PhpOne\LaravelAnnotation\Annotations\Mapping;
use PhpOne\LaravelAnnotation\Annotations\PostMapping;

class Parser
{
    public $scanDirs;
    public $routeData;
    const ROUTEANNOTATIONS = [
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
            $routeStruce = new RouteStruct();

            if (!empty($classInfo['c'])) {
                foreach (self::ROUTEANNOTATIONS as $routeAnnotation) {
                    if (!empty($classInfo['c'][$routeAnnotation])) {
                        /**
                         * @var $controllerAnnotation Controller
                         */
                        $controllerAnnotation = $classInfo['c'][$routeAnnotation];

                        $routeStruce->controller = $classInfo['s'];
                        $routeStruce->uri .= rtrim($controllerAnnotation->prefix, "/"). "/";
                    }
                }
            }

            $methods = $classInfo['m']??[];
            foreach ($methods as $methodName => $methdConfig) {
                foreach (self::MEDHODANNOTATIONS as $methodAnnotationClass) {

                    if (!empty($methdConfig[$methodAnnotationClass])) {
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
            $this->routeData[] = $routeStruce->generateRoute();
        }

        return $this->routeData;
    }

    /**
     * your route file
     * @param $outFile
     */
    public function writeRoute($outFile)
    {
        $this->getRoute();
        $this->createFile($outFile);
        foreach ($this->routeData as $route) {
            file_put_contents($outFile, "\r\n". $route, FILE_APPEND);
            fwrite(STDOUT, sprintf("\r\n wirte route: %s success \r\n", $route));
        }

    }

    public function createFile($file)
    {
        if (!file_exists(dirname($file))) {
            @mkdir(dirname($file), 0777, true);
        }
    }

}