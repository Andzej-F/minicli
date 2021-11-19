<?php

namespace Minicli;

class App
{
    /**
     * Property that references CliPrinter object
     * @var CliPrinter 
     */
    protected $printer;

    /**
     * Stores the application commands as anonymous function
     * @param array
     */
    protected $registry = [];

    public function __construct()
    {
        $this->printer = new CliPrinter();
    }

    /**
     * Get the printer object
     * 
     * @return object $printer
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * Stores application commands as anonymous functions identified by name
     * 
     * @param string $name Function name
     * @param callable $callable anonymous function
     */
    public function registerCommand(string $name, callable $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    /**
     * Displays a message
     * 
     * @param array $argv (Optional) Input array
     * 
     * @return void
     */
    public function runCommand(array $argv = [])
    {
        // $name = "World";

        // Default command, will be executed if no commad is set
        $command_name = "help";

        // Check if $argv[1] is set to a registered command name
        if (isset($argv[1])) {
            // $name = $argv[1];
            $command_name = $argv[1];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            $this->getPrinter()
                ->display("ERROR: Command \"$command_name\" not found.");
            exit;
        }

        call_user_func($command, $argv);

        // print_r(get_defined_vars());

        // echo "Hello $name!!!\n";
        // $this->getPrinter()->display("Hello $name!!!");
    }
}
