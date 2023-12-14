<?php

use Digiti\GoogleShoppingFeed\Item;

test('safeCharEncodeURL() with working url', function () {
    $result = (new Item)->safeCharEncodeURL('https://www.digiti.be/product/product-1?utm=123456789');
    expect($result)->toBe('https://www.digiti.be/product/product-1?utm=123456789');
});

test('safeCharEncodeURL() with suspicious url', function () {
    $result = (new Item)->safeCharEncodeURL('https://www.digiti.be/product/product-1?utm=123456789%&test=#<123>');
    expect($result)->toBe('https://www.digiti.be/product/product-1?utm=123456789%25&test=%23%3c123%3e');
});

test('safeCharEncodeText()', function () {
    $result = (new Item)->safeCharEncodeURL('This text is a test from Digiti® • this test makes sure it doesn\'t fail on production. Does it?');
    expect($result)->toBe('This%20text%20is%20a%20test%20from%20Digiti®%20•%20this%20test%20makes%20sure%20it%20doesn\'t%20fail%20on%20production.%20Does%20it?');
});
