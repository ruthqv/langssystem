<?php
namespace langs\langssystem;

use Illuminate\Database\Seeder;

class LangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LangsTableSeeder::class);
        $this->call(LangFieldsTableSeeder::class);

    }
}
