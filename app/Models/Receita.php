<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Receita extends Model
{
    use HasFactory;
    protected $table='receita';
    protected $fillable=['descricao','valor','data'];
}