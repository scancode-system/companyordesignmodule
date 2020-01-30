<?php

namespace Modules\CompanyOrDesign\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Modules\CompanyOrDesign\Repositories\ItemProductRepository;

class UpdateItemDiscountLimitListener
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

        if($data->discount == 0 || $data->discount > $item->product->discount_limit) 
        {
            ItemProductRepository::updateDiscountLimit($item->item_product, $item->product->discount_limit);
        } else 
        {
            ItemProductRepository::updateDiscountLimit($item->item_product,  $data->discount);
        }
    }
}
