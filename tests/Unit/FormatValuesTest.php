<?php

use Carbon\Carbon;
use Digiti\GoogleShoppingFeed\Item;

test('formatDate() with string', function () {
    $result = (new Item)->formatDate('2023-12-10 13:00');
    expect($result)->toBe('2023-12-10T13:00:00+00:00');
});

test('formatDate() with Carbon object', function () {
    $date = Carbon::now();
    $result = (new Item)->formatDate($date);
    expect($result)->toBe($date->toIso8601String());
});
