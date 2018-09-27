<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
	protected $table = "buildings";
    protected $fillable = ['name',
                            'lat', 
    						'lng', 
    						'year_built',
                            'height_type',
                            'nr_apartments',
                            'nr_people',
                            'surface',
                            'year_expertise',
                            'expert',
                            'details'];
    public $timestamps = true;
}
