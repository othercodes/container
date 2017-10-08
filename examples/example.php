<?php

require_once '../vendor/autoload.php';

$container = new \OtherCode\Container\Container(array(
    'date' => new DateTime(),
    'api' => 'https://some.api.url.com'
));

if ($container->has('date')) {
    print $container['date']->format('c');
}

if ($container->has('api')) {
    print $container['api'];
}

