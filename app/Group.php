<?php

namespace App;

    use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Group extends Model
{
    public static function boot()
    {
        parent::boot();

       static::addGlobalScope('is_default', function (Builder $builder) {
            $builder->where('is_default', '!=', true);
        });
    }

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y');
    }

    public static function getDefaultGroupId(User $user)
    {
        return $user
            ->groups()
            ->withoutGlobalScope('is_default')
            ->where('is_default', '=', 1)
            ->pluck('groups.id')
            ->shift();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}