<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function menu()
    {
        return $this->belongsToMany('App\Menu', 'opens', 'role_id', 'menu_id')->whereNull('opens.deleted_at');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleted(function ($query) {
    //         $query->users()->delete();
    //     });
    // }
}
