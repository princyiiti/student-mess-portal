<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_mess_data extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     * 
     */
    protected $table = 'student_mess_datas';
    protected $dates = ['deleted_at'];

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
    protected $fillable = ['student_name','hostel_name','student_rollno','room_no','program','to_date','from_date','mess_name','plan_type','image_file','status','type','created_by','created_at','updated_at','session_id','slot_id','deleted_at'];
   
}
