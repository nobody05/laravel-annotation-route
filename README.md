# laravel-annotation-route
laravel application generate route file by annotation

### Installation
```
composer require phpone/laravel-annontation-route
```

### Usage

```php
<?php
use PhpOne\LaravelAnnotation\Parser;

$parser = new Parser([__DIR__.'/Controller']);
$parser->writeRoute(__DIR__.'/route/api.php');

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



