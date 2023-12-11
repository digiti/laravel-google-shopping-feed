<?php

namespace Digiti\GoogleShoppingFeed;

use Illuminate\Support\ServiceProvider;

class GoogleShoppingFeedServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /**
         * Register Commands
         */
        $this->commands([
            //...
        ]);
    }

    public function register()
    {

    }
}
