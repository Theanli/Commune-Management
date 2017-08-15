<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'class';
    
    protected $fillable = [
          'firstname',
          'lastname',
          'dob',
          'sex'
    ];
    

    public static function boot()
    {
        parent::boot();

        Classroom::observe(new UserActionsObserver);
    }
    
    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDobAttribute($input)
    {
        if($input != '') {
            $this->attributes['dob'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['dob'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDobAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}