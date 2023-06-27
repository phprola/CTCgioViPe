<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    use HasFactory;
    protected $table = "leituravipegio";

    protected $fillable = [
        'idLeitura', 'DataLeitura', 'HoraLeitura', 'ValorSensor'
    ];
}
