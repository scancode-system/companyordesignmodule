<?php

namespace Modules\CompanyOrDesign\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

use Modules\Order\Events\ItemControllerAfterStoreEvent;
use Modules\Order\Events\ItemControllerBeforeUpdateEvent;
use Modules\CompanyOrDesign\Listeners\UpdateItemDiscountLockListener;

use Modules\Order\Events\ItemAfterDiscountParseEvent;
use Modules\CompanyOrDesign\Listeners\LockDiscountEvent;

class EventServiceProvider extends ServiceProvider 
{

	public function boot() 
	{

	}

	public function register() 
	{
		Event::listen(ItemControllerAfterStoreEvent::class, UpdateItemDiscountLockListener::class);
		Event::listen(ItemControllerBeforeUpdateEvent::class, UpdateItemDiscountLockListener::class);
		Event::listen(ItemAfterDiscountParseEvent::class, LockDiscountEvent::class);
	}

}