<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	protected $table = "badges";
    protected $fillable = ['name',
                            'photo', 
    						'created_at', 
    						'updated_at'];
    public $timestamps = true;
}
