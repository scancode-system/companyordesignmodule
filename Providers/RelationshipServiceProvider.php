<?php

namespace Modules\CompanyOrDesign\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Order\Entities\Item;
use Modules\CompanyOrDesign\Entities\ItemDiscountLock;

use Modules\Order\Entities\Order;


class RelationshipServiceProvider extends ServiceProvider
{


    public function boot()
    {
        Item::addDynamicRelation('item_discount_lock', function (Item $item) {
            return $item->hasOne(ItemDiscountLock::class);
        });
    }



    public function register()
    {

    }

}
