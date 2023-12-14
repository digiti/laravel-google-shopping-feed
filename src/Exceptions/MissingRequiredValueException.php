<?php

namespace Digiti\GoogleShoppingFeed\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MissingRequiredValueException extends Exception
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;

        parent::__construct("Missing required value: $this->value");
    }

    /**
     * Report the exception.
     */
    // public function report(): void
    // {
    //     // ...
    //     // Example: report to slack
    // }

    /**
     * Render the exception into an HTTP response.
     */
    // public function render(Request $request): Response
    // {
    //    //
    // }
}
