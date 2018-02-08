<?php
namespace langs\langssystem;

use Illuminate\Database\Seeder;

class LangsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('langs')->delete();
        
        \DB::table('langs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_lang' => 1,
                'name' => 'es',
                'iso_code' => 'es',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_lang' => 2,
                'name' => 'en',
                'iso_code' => 'en',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_lang' => 3,
                'name' => 'fr',
                'iso_code' => 'fr',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}