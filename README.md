# laravel-annotation-route
laravel application generate route file by annotation

### Installation
```
composer require phpone/laravel-annontation-route
```

### Usage

- add RouteAnnotationProviders to config/app.php
```php
<?php

return [
    'providers' => [
        //.......other serviceProvider
        \PhpOne\LaravelAnnotation\Providers\RouteAnnotationProviders::class,                  
    ]
];

```
- generate route file by command
```shell
php artisan annotation-route:generate
```



this function will scan Annotations of  Controller dir , and wirte into api.php
the file like this 
```php
<?php
Route::post("api/user/login","UserController@login");
Route::get("api/company/info","CompanyController@info");


```

### Annotations list
- @Controller
- @Mapping
- @PostMapping
- @GetMapping



