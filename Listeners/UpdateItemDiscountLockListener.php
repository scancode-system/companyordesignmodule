<?php

namespace Modules\CompanyOrDesign\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Modules\CompanyOrDesign\Repositories\ItemDiscountLockRepository;

class UpdateItemDiscountLockListener
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
        $data = $event->data(); 
        $item = $event->item();
        $item_discount_lock =  ItemDiscountLockRepository::loadByItem($item); //$item->item_discount_lock;
        // poderia ser assim $item_discount_lock = $item->load('item_discount_lock');
        
        $discount_limit = ($item->item_product)?$item->item_product->discount_limit:$item->product->discount_limit;

        //dd($item_discount_lock);

        if($data->discount == 0) {
            ItemDiscountLockRepository::update($item_discount_lock, null);   
        } else if($data->discount > $discount_limit){
            ItemDiscountLockRepository::update($item_discount_lock, $discount_limit);             
        } else {
            ItemDiscountLockRepository::update($item_discount_lock, $data->discount);   
        }
    }
}
