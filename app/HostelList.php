<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostelList extends Model
{
    protected $table = 'hostel_lists';
    protected $fillable = ['title'];
}
