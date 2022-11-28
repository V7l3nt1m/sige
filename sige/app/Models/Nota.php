<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'disciplina',
        'aluno_id',
        't1_p1',
        't1_mac',
        't1_p2',
        't1_mdf',
        't2_mac',
        't2_p1',
        't2_p2',
        't2_mdf',
        't3_p1',
        't3_mac',
        't3_pf',
        't3_mdf',
        'recurso',
    ];

    protected $guarded = [];
}
