<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReceitaTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
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

    public function test_exibirTodas()
    {
        $response = $this->get(route('receita.todas'),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_exibirUma()
    {
        $response = $this->get(route('receita.uma',2),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_atualizar()
    {
        $response = $this->put(route('receita.atualizar',2),[
            "descricao"=>"atualizado",
            "valor"=>"500",
            "data"=>"01-03-2022"
        ]);

        $response->assertStatus(200);
    }

    public function test_deletar()
    {
        $response = $this->delete(route('receita.deletar',2),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_receitasMes()
    {
        $response = $this->get(route('receita.anomes',[2022,01]),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_buscarReceita()
    {
        $response = $this->get(route('receita.todasbusca',"descricao=seed tres"),[
            
        ]);

        $response->assertStatus(200);
    }
}