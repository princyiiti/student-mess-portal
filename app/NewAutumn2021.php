<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewAutumn2021 extends Model
{
    protected $table = 'new_autumn_2021';
    protected $fillable = ['rollno          ','name','prog','dept','father_name','caste','p_email','email','contact','permanent_address','permanent_state','permanent_pincode','permanent_city','correspondence_address','correspondence_city','correspondence_state',' correspondence_pincode','qexam','spec','gender','funding'];
}
