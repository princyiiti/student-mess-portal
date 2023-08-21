<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feestructuredetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feestructuredetails';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
     protected $status = 0;
     protected $type = 0;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fee_type','amount','feestructure_id','status','type'];

     public static function boot() {
        parent::boot();
          static::creating(function ($model) {
        $model->status = 0;
         $model->type = 0;
    });
        self::created(function($model) {
     
        });    
        self::updated(function($model){

        });
        self::updating(function($model){

        });
        self::deleted(function($model){

        });
        self::deleting(function($model){

        });
        self::saving(function($model){

        });
        self::saved(function($model){

  
        });
        }
}
