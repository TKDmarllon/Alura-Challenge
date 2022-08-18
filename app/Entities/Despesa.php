<?php

namespace App\Entities;

use DateTime as Date;

use function PHPUnit\Framework\isEmpty;

class Despesa
{
    protected string $descricao;
    protected float $valor;
    protected ?string $categoria;
    protected Date $data;

    public function __construct(
        string $descricao, 
        float $valor,
        Date $data,
        ?string $categoria = 'Outras'
    ) {
        $this->descricao = $descricao;
        $this->valor=$valor;
        $this->categoria=empty($categoria)?'Outras':$categoria;
        $this->data=$data;
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

    public function setCategoria(?string $categoria)
    {
        $this->categoria=$categoria;
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

    public function getCategoria()
    {
         return $this->categoria;
    }

    public function toArray()
    {
        return [
            "descricao"=>$this->descricao,
            "valor"=>$this->valor,
            "categoria"=>$this->categoria,
            "data"=>$this->data->format("Y-m-d"),
        ];
    }
}