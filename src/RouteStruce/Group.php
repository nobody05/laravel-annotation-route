<?php


namespace PhpOne\LaravelAnnotation\RouteStruce;

/**
 *
 *   Route::group(['prefix' => 'media', 'middle'], function () {
 *       Route::get('mediaList', 'MediaController@mediaList');
 *       Route::get('mainAccountList', 'MediaController@mainAccountList');
 *   });
 *
 *
 * Class Group
 * @package PhpOne\LaravelAnnotation\RouteStruce
 */
class Group
{
    public string $middlewares;
    public string $prefix;
    public string $namespace;

    /**
     * @var Route[] $routes
     */
    public array $routes;
    private string $iPrefix = "Route::group(";
    private string $iSuffix = ");";
    private string $attributes;


    public function toString(): string
    {
        $s = $this->iPrefix;
        $s .= $this->attributeString();
        $s .= $this->closureString();
        $s .= $this->iSuffix;

        return $s;
    }

    protected function closureString(): string
    {
        $s = ', function () {';
        $s .= $this->routeString();
        $s .= "\r\n}";

        return $s;
    }

    protected function routeString(): string
    {
        $s = '';
        foreach ($this->routes as $route) {
            $s .= $route->toString();
        }

        return $s;
    }

    protected function attributeString(): string
    {
        $s = '[';
        $s .= $this->prefixString();
        $s .= $this->namespaceString();
        $s .= $this->middlewaresString();
        $s = trim($s, ',');
        $s .= ']';

        return $s;

    }

    protected function namespaceString(): string
    {
        return !empty($this->namespace) ? "'namespace' => '". $this->namespace."'," : '';
    }

    protected function prefixString(): string
    {
        return !empty($this->prefix) ? "'prefix' => '". $this->prefix."'," : '';
    }

    protected function middlewaresString(): string
    {
        if (empty($this->getMiddlewares())) return "";
        $s = " 'middleware' => [";
        foreach ($this->getMiddlewares() as $middleware) {
            $s .= "'".$middleware."',";
        }
        $s = rtrim($s, ',');
        $s .= ']';

        return $s;
    }

    /**
     * @return mixed
     */
    public function getMiddlewares()
    {
        return empty($this->middlewares) ? [] : explode(',', $this->middlewares);
    }

    /**
     * @param mixed $middlewares
     */
    public function setMiddlewares($middlewares): void
    {
        $this->middlewares = $middlewares;
    }




}