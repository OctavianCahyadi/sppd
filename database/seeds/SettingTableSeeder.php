<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_setting')->insert([
            'id_kadis' => '1',
            'id_bendahara' => '4',
            'mata_anggaran' => 'APBD Kab.Bantul',
            'tahun_anggaran' => '2020',
        ]);   
         
    }
}
