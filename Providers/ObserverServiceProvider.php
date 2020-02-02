<?php

namespace Modules\CompanyOrDesign\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Order\Entities\Item;
use Modules\CompanyOrDesign\Observers\ItemObserver;

class ObserverServiceProvider extends ServiceProvider {

	public function boot() {
		Item::observe(ItemObserver::class);
	}

	public function register() {
        //
	}

}
