<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    
    
    
     public static function boot() {
        parent::boot();
        self::created(function($model) {});    
        self::updated(function($model){});
        self::updating(function($model){});
        self::deleted(function($model){});
        self::deleting(function($model){});
        self::saving(function($model){});
        self::saved(function($model){});
        }
   

}
