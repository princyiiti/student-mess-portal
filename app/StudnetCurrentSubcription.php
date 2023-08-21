<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudnetCurrentSubcription extends Model
{
    protected $fillable = ['student_name','student_email','student_roll_no','mess_name','plan_type','start_date','end_date','status','deleted_at','subcription_id'];

    
}
