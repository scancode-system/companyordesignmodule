<?php

namespace Modules\CompanyOrDesign\Observers;


use Modules\Order\Entities\Item;
use Modules\CompanyOrDesign\Repositories\ItemDiscountLockRepository;

class ItemObserver
{


	public function created(Item $item)
	{
		ItemDiscountLockRepository::create($item);
	}	


}
