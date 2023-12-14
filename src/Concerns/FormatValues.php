<?php

namespace Digiti\GoogleShoppingFeed\Concerns;

use Carbon\Carbon;

trait FormatValues{
    /**
     * @param $date
     */
    public function formatDate(string|Carbon $date): string
    {
        $date = is_string($date) ? Carbon::parse($date) : $date;
        return $date->toIso8601String();
    }
}
