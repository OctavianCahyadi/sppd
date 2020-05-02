<?php

use Illuminate\Database\Seeder;

class PptkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_pptk')->insert([
            [
                'id_karyawan' => '3',
            ],
            [
                'id_karyawan' => '5',
            ],
   
        ]);  
    }
}

    