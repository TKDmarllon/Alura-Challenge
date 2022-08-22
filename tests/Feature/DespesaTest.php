<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DespesaTest extends TestCase
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
            $response = $this->post(route('despesa.criar'),[
            "descricao"=> "teste criar",
            "valor"=> "1000",
            "data"=> "01-02-2022",
            "categoria"=>"Saúde"
        ]);

        $response->assertStatus(201);
    }

    public function test_exibirTodas()
    {
        $response = $this->get(route('despesa.todas'),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_exibirUma()
    {
        $response = $this->get(route('despesa.uma',1),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_atualizar()
    {
        $response = $this->put(route('despesa.atualizar',1),[
            "descricao"=>"atualizado",
            "valor"=>"500",
            "data"=>"01-03-2022"
        ]);

        $response->assertStatus(200);
    }

    public function test_deletar()
    {
        $response = $this->delete(route('despesa.deletar',2),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_despesaMes()
    {
        $response = $this->get(route('despesa.anomes',[2022,01]),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_buscarDespesa()
    {
        $response = $this->get(route('despesa.todasbusca',"descricao=seed tres"),[
            
        ]);

        $response->assertStatus(200);
    }

    public function test_criarErroDescricao()
    {
            $response = $this->post(route('despesa.criar'),[
            "descricao"=> "",
            "valor"=> "1000",
            "data"=> "01-02-2022",
            "categoria"=>"Saúde"
        ]);

        $response->assertStatus(400);
    }

    public function test_criarErroValor()
    {
            $response = $this->post(route('despesa.criar'),[
            "descricao"=> "teste criar",
            "valor"=> "-20",
            "data"=> "01-02-2022",
            "categoria"=>"Saúde"
        ]);

        $response->assertStatus(400);
    }

    public function test_criarErroData()
    {
            $response = $this->post(route('despesa.criar'),[
            "descricao"=> "teste criar",
            "valor"=> "-20",
            "data"=> "040-02-2022",
            "categoria"=>"Saúde"
        ]);

        $response->assertStatus(400);
    }

    public function test_criarErroDuplicidade()
    {
            $response = $this->post(route('despesa.criar'),[
            "descricao"=> "seed um",
            "valor"=> "1000",
            "data"=> "01-01-2022",
            "categoria"=>"Saúde"
        ]);

        $response->assertStatus(400);
    }

    public function test_criarErroCategoria()
    {
            $response = $this->post(route('despesa.criar'),[
            "descricao"=> "teste criar",
            "valor"=> "-20",
            "data"=> "04-02-2022",
            "categoria"=>"Carro"
        ]);

        $response->assertStatus(400);
    }

    public function test_exibirUmaErroId()
    {
        $response = $this->get(route('despesa.uma',0),[
            
        ]);

        $response->assertStatus(404);
    }

    public function test_atualizarErroId()
    {
        $response = $this->put(route('despesa.atualizar',0),[
            "descricao"=>"atualizado",
            "valor"=>"500",
            "data"=>"01-03-2022"
        ]);

        $response->assertStatus(404);
    }

    public function test_atualizarErroValor()
    {
        $response = $this->put(route('despesa.atualizar',1),[
            "descricao"=>"atualizado",
            "valor"=>"-10",
            "data"=>"01-03-2022"
        ]);

        $response->assertStatus(400);
    }

    public function test_atualizarErroData()
    {
        $response = $this->put(route('despesa.atualizar',1),[
            "descricao"=>"atualizado",
            "valor"=>"500",
            "data"=>"40-03-2022"
        ]);

        $response->assertStatus(400);
    }

    public function test_deletarErroId()
    {
        $response = $this->delete(route('despesa.deletar',false),[
            
        ]);

        $response->assertStatus(405);
    }
}
