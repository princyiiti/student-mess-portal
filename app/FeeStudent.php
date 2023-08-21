<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentTotalFee;
class FeeStudent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fee_students';

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
    protected $fillable = ['rollno','student_name','academic_tearm','academic_year','fee_type','amount','status','type','created_by'];

    

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

$dataAll=  FeeStudent::where('rollno', '=',$model->rollno)
     ->where('academic_tearm', '=',$model->academic_tearm)
      ->where('academic_year', '=',$model->academic_year)
    ->get();
    $totalamount=0;
    foreach($dataAll as $vall){
        $totalamount=$vall->amount+$totalamount;
    }
    $olddata=StudentTotalFee::where('rollno', '=',$model->rollno)
     ->where('academic_tearm', '=',$model->academic_tearm)
      ->where('academic_year', '=',$model->academic_year)
    ->first();
    if(empty($olddata)){
     $newmodel =new StudentTotalFee();
        $newmodel->rollno=  $model->rollno;
          
            $newmodel->academic_tearm= $model->academic_tearm;
            $newmodel->academic_year=  $model->academic_year;
         
          $newmodel->fee_type="OK";
          $newmodel->status=0;
          $newmodel->type=0;
            $newmodel->totalamount= $model->amount;
            $newmodel->save();
    }else{
      $olddata->totalamount=$totalamount;
      $olddata->save();
    }
    echo $totalamount.'=>';
    echo $model->rollno.'<br>';
        });
        }
}
