<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('receita')->insert([
            "descricao"=> "seed um",
            "valor"=> "1000",
            "data"=> "2022-01-01"
        ]);

        DB::table('receita')->insert([
            "descricao"=> "seed dois",
            "valor"=> "2000",
            "data"=> "2022-02-02"
        ]);

        DB::table('receita')->insert([
            "descricao"=> "seed tres",
            "valor"=> "3000",
            "data"=> "2022-02-02"
        ]);
    }
}
