<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use ElasticquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        User::created(function($user) 
        {
            $group = new Group();
            $group->name = 'user-default';
            $group->description = 'This is the default group for the user. This group will not be visible to the user. This group would also not be shareable';
            $group->is_default = true;
            $group->save();

            $user->groups()->attach($group->id);
        });
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function expenses()
    {
        $groups = $this->groups()->withoutGlobalScope('is_default')->pluck('groups.id');
        return Expense::whereIn('group_id', $groups);
    }
}
