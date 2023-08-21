<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feestructure extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feestructures';

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
    protected $fillable = ['category','ademission_year','academic_tearm','academic_year','program','totalamount','status','type'];


    //   public function Feestructuredata()
    // {
    //     return $this->belongsTo(Feestructure::class, 'feestructure_id');
    // }

    public function FeeDetails(){
      return $this->hasMany(Feestructuredetail::class, 'feestructure_id', 'id');
    }


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
