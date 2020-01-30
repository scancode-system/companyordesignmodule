<?php

namespace Modules\CompanyOrDesign\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

use Modules\Order\Events\ItemControllerAfterStoreEvent;
use Modules\Order\Events\ItemControllerBeforeUpdateEvent;

use Modules\CompanyOrDesign\Listeners\UpdateItemDiscountLimitListener;


class EventServiceProvider extends ServiceProvider 
{

	public function boot() 
	{

	}

	public function register() 
	{
		Event::listen(ItemControllerAfterStoreEvent::class, UpdateItemDiscountLimitListener::class);
		Event::listen(ItemControllerBeforeUpdateEvent::class, UpdateItemDiscountLimitListener::class);
	}

}