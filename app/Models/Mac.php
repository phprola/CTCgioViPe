<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mac extends Model
{
    use HasFactory;
    protected $table = "mac";

    protected $fillable = [
        'idmac', 'nome', 'contador'
    ];
}
