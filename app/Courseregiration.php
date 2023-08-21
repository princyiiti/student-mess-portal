<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Courseregiration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courseregirations';

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
    protected $fillable = ['department','program','studyingyear','status','semester','fee_type','deparmentlelectivecount','openlelectivecount','type','created_by','maxopenelective'];

      public function Chieldlist()
    {
        return $this->hasMany('App\Courseregirationchiled');
      //  return $this->belongsTo(Courseregirationchiled::class, 'parent_id');
    }

    // public function registerstudent()
    // {
    //     return $this->belongsTo(NewAutumn2021::class, 'rollno','rollno');
    // }

public static function getcoursedetail($crsecode){
  $coursedata= DB::table('courselist')->where('crsecode',$crsecode)->first();
  if(!empty( $coursedata))
  return $coursedata->crsename.'('.$coursedata->lecture.'-'.$coursedata->tutorial.'-'.$coursedata->practical.'-'.$coursedata->totcred.')' ;
else
  return "";
}

public static function getcoursedetailcount($crsecode){
 $coursedata= DB::table('student_curr_course')->where('crsecode',$crsecode)->count();
 if($coursedata>240)
  return false;
else
  return true;


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
