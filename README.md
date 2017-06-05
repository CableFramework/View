# View
View Library For Cable Framework


```php 

$container = \Cable\Container\Factory::create();
$container->singleton(
    \Cable\Config\Config::class,
    function () {
        return new Cable\Config\Config(
            array(
                'view' => [
                    'path' => 'view/',
                    'cache' => 'cache/',
                ],
            )
        );
    }
);

$container->addProvider(\Cable\View\ViewServiceProvider::class);



```


## Blade 

```php 


$blade = $container->make(\Cable\View\BladeDriverInterface::class);

echo $blade->make('index', array(
    'test' => 'hello world' 
     ));
```

## Twig
 
 
 ```php
 
 $container->addProvider(\Cable\View\TwigServiceProvider::class);
 
 $twig = $twig->with('test', 'hello world')
              ->make('index.html');
 
 ```
 
 
 view: 'app/view'
 cache: 'storage/cache'