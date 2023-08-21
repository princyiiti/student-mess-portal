<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTotalFee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_total_fees';

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
    protected $fillable = ['rollno','student_name','academic_tearm','academic_year','fee_type','totalamount','due_amount','status','type','created_by','transaction_id','referance_no','partial_transaction_id','payment_date','paid_date','paid_amount','feestructure_id','file','income_file','parentalincome','remissiontype','remission','remission_amount'];

      public function Feestructuredata()
    {
        return $this->belongsTo(Feestructure::class, 'feestructure_id');
    }

    public function registerstudent()
    {
        return $this->belongsTo(NewAutumn2021::class, 'rollno','rollno');
    }

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
