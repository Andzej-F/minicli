<?php

use Minicli\App;

if (PHP_SAPI_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

$app = new App();
/*
$message = 'Hi';
$say = function () use ($message) {
    $message = 'Hello';
    echo $message;
};

$say();

echo $message;

public function registerCommand(string $name, callable $callable)
{
    $this->registry[$name] = $callable;
}
*/
// Register command "hello"
// "use" construct is used to access $app variable from the outer/parent scope
// By default, the variable is passed by value, not by reference
$app->registerCommand(
    'hello', // string $name
    function (array $argv) use ($app) { // callable $callable
        $name = isset($argv[2]) ? $argv[2] : "World"; // ok
        $app->getPrinter()->display("Hello $name!!!"); //ok
    }
);

// Register command "help"
$app->registerCommand('help', function (array $argv) use ($app) {
    $app->getPrinter()->display("usage:minicli hello [your-name]");
});

$app->runCommand($argv);
