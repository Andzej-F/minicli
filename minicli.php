#!/usr/bin/php
<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Minicli\App;

$app = new App();
/*public function registerController($name, CommandController $controller)
    {
        $this->command_registry->registerController($name, $controller);
    } 
    
    abstract class CommandController
{
    protected $app;

    abstract public function run($argv);

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function getApp()
    {
        return $this->app;
    }
}*/
$app->registerController('hello', new \App\Command\HelloController($app));

$app->registerCommand('help', function (array $argv) use ($app) {
    $app->getPrinter()->display("usage: minicli hello [ your-name ]");
});


// Register command "hyphenate"
$app->registerCommand(
    'hyphenate',
    function (array $argv) use ($app) {
        $hyphenate = isset($argv[2]) ? $argv[2] : "Enter a word or a command "; // ok
        $app->getPrinter()->display("!Hyp=hen-ated-word!!"); //ok
    }
);

// Register command "exit"
$app->registerCommand(
    'exit',
    function (array $argv) use ($app) {
        $exit = isset($argv[2]) ? $argv[2] : "Enter a command"; // ok
        $app->getPrinter()->display($exit); //ok
    }
);

$app->runCommand($argv);

// command [ subcommand ] [ action ] [ params ]
// command [ subcommand 1 ] [ subcommand n ] [ params ]

// docker image [ import | build | history | ls | pull | prune ... ]
// docker container [ build | info | kill | pause | rename | rm ... ]