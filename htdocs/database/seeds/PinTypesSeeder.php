<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PinTypesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('pin_types')->insert([
            [	
            	'id' => 1,
            	'name' => 'simple pin',
            ],
            [	
            	'id' => 2,
            	'name' => 'medical emergency',
            ],
            [	
            	'id' => 3,
            	'name' => 'blocked access',
            ],
            [	
            	'id' => 4,
            	'name' => 'leekage of gas',
            ],
            [	
            	'id' => 5,
            	'name' => 'building collapsed',
            ],
        ]);
    }
}
