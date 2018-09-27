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
    						'badge_id', 
                            'emotions_coefficient',
                            'sentiment', 
    						'created_at', 
    						'updated_at'];
    public $timestamps = true;

    /**
        Pin type foreign key relationship
    */
    public function pinType() {
        return $this->hasOne('App\Models\PinType', 'pin_type_id');
    }
    
    /**
        badge foreign key relationship
    */
    public function badge() {
        return $this->hasOne('App\Models\Badge');
    }
}
