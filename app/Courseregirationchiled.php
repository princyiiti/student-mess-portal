<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseregirationchiled extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courseregirationchileds';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * 
     *      $table->string('department')->nullable();
            $table->string('program')->nullable();
            $table->string('studyingyear')->nullable();
            $table->integer('status')->nullable();
            $table->integer('deparmentlelectivecount')->nullable();
            $table->integer('openlelectivecount')->nullable();
            $table->integer('type')->nullable();
            $table->string('created_by')->nullable();
     * @var array
     */
    protected $fillable = ['coursecode','coursename','coursetype','courseregiration_id'];

    //   public function Feestructuredata()
    // {
    //     return $this->belongsTo(Feestructure::class, 'feestructure_id');
    // }

    // public function registerstudent()
    // {
    //     return $this->belongsTo(NewAutumn2021::class, 'rollno','rollno');
    // }

      public static function boot() {
        parent::boot();
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
