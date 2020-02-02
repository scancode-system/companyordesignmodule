<?php

namespace Modules\CompanyOrDesign\Repositories;

use Modules\CompanyOrDesign\Entities\ItemDiscountLock;
use Modules\Order\Entities\Item;

class ItemDiscountLockRepository
{

	// LOAD
	public static function loadByItem(Item $item)
	{
//		return $item->item_discount_lock;
		return ItemDiscountLock::where('item_id', $item->id)->first();
	}

	// CREATE
	public static function create(Item $item)
	{
		return ItemDiscountLock::create(['item_id' => $item->id]);
	}

	// UPDATE
	public static function update(ItemDiscountLock $item_disount_lock, $discount)
	{
		$item_disount_lock->percentage = $discount;
		$item_disount_lock->save();
	}

}
