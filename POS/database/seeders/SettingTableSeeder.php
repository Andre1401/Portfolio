<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'nama_perusahaan' => 'TOKOKU',
            'alamat' => 'Jl. Merdeka No.20',
            'telepon' => '08232423478',
            'tipe_nota' => 1, // kecil
            'diskon' => 5,
            'path_logo' => '/img/logo_POS(1).png',
            'path_kartu_member' => '/img/member.png',
        ]);
    }
}
