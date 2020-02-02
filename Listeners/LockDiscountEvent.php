<?php

namespace Modules\CompanyOrDesign\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LockDiscountEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $item = $event->item();
        if($item->item_discount_lock)
        {
            if(!is_null($item->item_discount_lock->percentage))
            {
                $item->discount = $item->item_discount_lock->percentage;            
            }
        }
    }
}
