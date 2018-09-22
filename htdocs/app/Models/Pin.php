<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
	protected $table = "pins";
    protected $fillable = ['address', 
    						'details', 
    						'lat', 
    						'lng', 
    						'status', 
    						'pin_type_id', 
    						'badge_type_id',  
    						'created_at', 
    						'updated_at'];
    public $timestamps = true;
}
