<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    use HasFactory;
    protected $table = "leitura";

    protected $fillable = [
        'idleitura', 'dataLeitura', 'horaLeitura', 'valorSensor'
    ];
}
