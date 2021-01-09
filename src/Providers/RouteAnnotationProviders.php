<?php


namespace PhpOne\LaravelAnnotation\Providers;


use Closure;
use Illuminate\Support\ServiceProvider;
use PhpOne\LaravelAnnotation\Command\GenerateRouteCommand;

class RouteAnnotationProviders extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateRouteCommand::class
            ]);
        }
    }


}