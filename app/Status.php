<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function rents()
    {
        return $this->hasMany('App\Rent');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleted(function ($query) {
    //         $query->rents()->delete();
    //     });
    // }
}
