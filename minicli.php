#!C:\xampp\htdocs\PHP\other\php.exe.
<?php

use Minicli\App;

if (PHP_SAPI_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

$app = new App();

// Register command "hello"
$app->registerCommand('hello', function (array $argv) use ($app) {
    $name = isset($argv[2]) ? $argv[2] : "World";
    $app->getPrinter()->display("Hello $name!!!");
});

// Register command "help"
$app->registerCommand('help', function (array $argv) use ($app) {
    $app->getPrinter()->display("usage:minicli hello [your-name]");
});

$app->runCommand($argv);
