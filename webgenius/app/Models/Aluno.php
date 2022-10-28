<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Aluno extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    
    protected $fillable = [
        'nome_aluno',
        'num_processo',
        'data_nasc',
        'email_aluno',
        'telefone_aluno',
        'genero',
        'nota_aluno',
        'num_faltas',
        'estado_aprovado',
        'propina',
        'imagem_aluno',
        'turma_id',
        'senha_aluno',
    ];
    protected $hiden = [
        'senha_aluno',
    ];

    protected $dates = ['date'];
    protected $guarded = [];

    public function turma(){
        return $this->belongsTo('App\Models\Turma');
        
    }
    public function classe(){
        return $this->belongsTo('App\Models\Classe');
    }
    public function curso(){
        return $this->belongsTo('App\Models\Curso');
        
    }
    public function aluno(){
        return $this->belongsTo('App\Models\User');
    }
}
