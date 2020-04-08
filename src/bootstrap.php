<?php

declare(strict_types=1);



use Phalcon\Cli\Console;
use Phalcon\Cli\Dispatcher;
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Exception as PhalconException;
use Phalcon\Loader;
use Dotenv\Dotenv;



$rootPath = realpath('.');
require_once $rootPath . '/vendor/autoload.php';

$loader = new Loader();
$loader->registerNamespaces(
    [
        'App' => 'src/',
    ]
);
$loader->register();

$container  = new CliDI();
$dispatcher = new Dispatcher();

$dispatcher->setDefaultNamespace('App\Tasks');
$container->setShared('dispatcher', $dispatcher);

Dotenv::createImmutable($rootPath)->load();

$container->setShared('db', function () {

    $class = '\Phalcon\Db\Adapter\Pdo\\' . getenv('DB_ADAPTER');
    $params = [
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_DBNAME'),
        'charset' => getenv('DB_CHARSET'),
    ];

    if (getenv('DB_ADAPTER') == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});

$console = new Console($container);


$arguments = [];

foreach ($argv as $k => $arg) {
    if ($k === 1) {
        $arguments['task'] = $arg;
    } elseif ($k === 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}


try {
    $console->handle($arguments);
} catch (PhalconException $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
} catch (Throwable $throwable) {
    fwrite(STDERR, $throwable->getMessage() . PHP_EOL);
    exit(1);
} catch (Exception $exception) {
    fwrite(STDERR, $exception->getMessage() . PHP_EOL);
    exit(1);
}