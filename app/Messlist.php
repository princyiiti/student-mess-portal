<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messlist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messlist';
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
    protected $fillable = ['title','studentlimit','email'];

    
}
