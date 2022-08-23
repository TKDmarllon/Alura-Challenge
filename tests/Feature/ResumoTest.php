<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResumoTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_resumoMes()
    {
        $response = $this->get(route('resumo.resumo',[2022,01]),[
            
        ]);

        $response->assertStatus(200);
    }
}
