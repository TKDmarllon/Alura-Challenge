<?php

namespace App\Entities;

use DateTime as Date;

class Receita
{
    protected string $descricao;
    protected float $valor;
    protected Date $data;

    public function __construct(
        string $descricao, 
        float $valor, 
        Date $data
    ) {
        $this->descricao = $descricao;
        $this->valor= $valor;
        $this->data= $data;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao=$descricao;
    }

    public function setValor(float $valor)
    {
        $this->valor=$valor;
    }

    public function setdata(Date $data)
    {
        $this->data=$data;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getdata()
    {
        return $this->data;
        
    }

    public function toArray()
    {
        return [
            "descricao"=>$this->descricao,
            "valor"=>$this->valor,
            "data"=>$this->data->format("d-m-Y")
        ];
    }
}