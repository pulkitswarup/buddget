<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function getPurchasedAtAttribute($value) 
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }

    public function setPurchasedAtAttribute($value) 
    {
        $this->attributes['purchased_at']  = Carbon::createFromFormat('d-m-Y', $value)->toDateString();
    }

    public function getAmountAttribute($value)
    {
        return ($value / 100);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}
