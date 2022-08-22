<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DespesaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('despesa')->insert([
            "descricao"=> "seed um",
            "valor"=> "1000",
            "data"=> "2022-01-01",
            "categoria"=>"Saúde"
        ]);

        DB::table('despesa')->insert([
            "descricao"=> "seed dois",
            "valor"=> "2000",
            "data"=> "2022-02-02",
            "categoria"=>"Transporte"
        ]);

        DB::table('despesa')->insert([
            "descricao"=> "seed tres",
            "valor"=> "3000",
            "data"=> "2022-03-03",
            "categoria"=>"Educaçao"
        ]);
    }
}
