<?php


namespace Kaum\Harreek\Abstracts\Exceptions;
use Exception as LaravelException;

abstract class BaseException extends LaravelException
{
    protected array $errors = [];

    public function withErrors($errors, bool $override = true): BaseException {
        if ($override) {
            $this->errors = $errors;
        } else {
            $this->errors = array_merge($this->errors, $errors);
        }

        return $this;
    }

    public function getErrors(): array {
        $errors = [];

        foreach ($this->errors as $key => $value) {
            $translations = [];

            if (is_array($value)) {
                foreach ($value as $translatedKey) {
                    $translations[] = __($translatedKey);
                }
            } else {
                $translations[] = __($value);
            }

            $errors[$key] = $translations;
        }

        return $errors;
    }
}