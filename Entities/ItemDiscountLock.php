<?php

namespace Modules\CompanyOrDesign\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemDiscountLock extends Model
{
    protected $fillable = ['item_id', 'percentage'];
}
