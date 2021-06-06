<?php


namespace Kaum\Harreek\Abstracts\Actions;


abstract class BaseAction
{
    protected string $interface;

    public function getInterface(): string
    {
        return $this->interface;
    }

    public function setInterface($interface): BaseAction
    {
        $this->interface = $interface;
        return $this;
    }
}