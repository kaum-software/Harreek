<?php
namespace Kaum\Harreek\Traits;

trait ValidationTrait
{
    public function rules(): void {
        // A Rule that disallows spaces in a string
        \Validator::extend('no_spaces', function ($attributes, $value, $parameters, $validator) {
            return preg_match("/^\S*$/u", $value);
        }, "Spaces are not allowed");

        // TODO: Add Different useful rules
    }
}