<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinType extends Model
{
	protected $table = "pin_types";
    protected $fillable = ['name',
                            'default_badge_id',
                            'custom_badge',
                            'created_at' 
    						'updated_at'];
    public $timestamps = true;

    public function badge() {
        return $this->hasOne('App\Models\Badge');
    }
}

