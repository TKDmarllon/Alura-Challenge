<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReceitaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_criar()
    {
        $response = $this->post(route('receita.criar'),[
            "descricao"=> "teste criar",
            "valor"=> "1000",
            "data"=> "01-02-2022"
        ]);

        $response->assertStatus(201);
    }
}
