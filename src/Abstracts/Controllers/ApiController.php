<?php


namespace Kaum\Harreek\Abstracts\Controllers;


use Kaum\Harreek\Traits\ResponseTrait;

abstract class ApiController extends BaseController
{
    use ResponseTrait;

    public string $ui = 'api';
}