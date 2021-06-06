<?php


namespace Kaum\Harreek\Abstracts\Mails;


use Illuminate\Mail\Mailable as LaravelMailable;
use Illuminate\Queue\SerializesModels;

abstract class BaseMail extends LaravelMailable
{
    use SerializesModels;
}