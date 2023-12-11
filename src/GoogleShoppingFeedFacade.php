<?php

namespace Digiti\GoogleShoppingFeed;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Digiti\GoogleShoppingFeed
 */
class GoogleShoppingFeedFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'google-shopping-feed';
    }
}
