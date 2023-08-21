<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
class Rebate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rebates';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     * ALTER TABLE `slots` ADD `student_to_date` VARCHAR(255) NULL AFTER `from_date`, ADD `student_from_date` INT(255) NULL AFTER `student_to_date`;
     * @var array
     */
    protected $fillable = ['to_date','from_date','status','created_by','created_at','updated_at','session_id','student_to_date','type_rebate','reason','mess_name','mess_subcription_id','total_rebate_day','file_path'];

     public function userdata()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function subcription_data()
    {
        return $this->belongsTo(Student_mess_data::class, 'mess_subcription_id');
    }

    public static  function countday($item){

        $val = Rebate::get();

        $days=Rebate::where('mess_subcription_id',$item->id)->where('created_by',$item->created_by)
        ->where('status',1)->where('mess_name',$item->mess_name)->sum('rebates.total_rebate_day');


        if($days){
            return $days;
        }else{
            return 0;
        }
          

   }
    // public static  function countday($item){

    //      $modelrebate=Rebate::where('from_date','>=',$item->from_date)
    //      ->where('to_date','<=',$item->to_date)->where('created_by',$item->created_by)
    //      ->where('status',1)->where('mess_name',$item->mess_name)->get();
    //         if(!empty($modelrebate))
    //         { 
    //             $days =0;
    //             foreach ($modelrebate as  $value) {
    //                 # code...
    //                  $date1 = new DateTime($value->from_date);
    //                  $date2 = new DateTime($value->to_date);
    //                  $days  = $days +$date2->diff($date1)->format('%a')+1;
    //             }
           
    //             return $days;
    //         }else{
    //             return 0;
    //         }

    // }

    
}