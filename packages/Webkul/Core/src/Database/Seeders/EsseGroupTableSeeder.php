<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EsseGroupTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('essegroup')->delete();

        DB::table('essegroup')->insert([
            'id' => 1,
            'content' => ''
        ]);
    }
}