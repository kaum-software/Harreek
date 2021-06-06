<?php
namespace Kaum\Harreek\Abstracts\Commands;



use Illuminate\Console\Command as LaravelCommand;

abstract class BaseConsoleCommand extends LaravelCommand {
    public string $ui = 'term';
}