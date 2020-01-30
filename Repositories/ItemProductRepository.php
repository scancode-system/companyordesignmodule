<?php

namespace Modules\CompanyOrDesign\Repositories;

use Modules\Order\Repositories\ItemProductRepository as ItemProductRepositoryBase;

use Modules\Order\Entities\ItemProduct;
use Modules\Order\Entities\Status;

class ItemProductRepository extends ItemProductRepositoryBase
{

	public static function updateDiscountLimit(ItemProduct $item_product, $discount_limit)
	{
		$item_product->discount_limit = $discount_limit;
		$item_product->save();
	}

}
