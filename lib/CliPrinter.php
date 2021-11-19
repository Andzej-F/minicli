<?php

namespace Minicli;

/**
 * CliPrinter is a helper class that handles output to the terminal
 * 
 * PHP version 8.0.7
 */

class CliPrinter
{
    /**
     * Output a message
     * 
     * @param string $message User's input
     * 
     * @return void
     */
    public function out(string $message)
    {
        echo $message;
    }

    /**
     * Print a new line
     * 
     * @return void
     */
    public function newline()
    {
        $this->out("\n");
    }

    /**
     * Dispplays message, wrapped with new lines
     * 
     * @param string $message User's input
     * 
     * @return void
     */
    public function display($message)
    {
        $this->newline();
        $this->out($message);
        $this->newline();
        $this->newline();
    }
}
