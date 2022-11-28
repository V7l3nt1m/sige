@extends('layouts.layoutsige')

@section('title', 'Secretária')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/secretaria/perfil">Ver Perfil</a>
<a class="dropdown-item" href="/secretaria/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <a href="#"><i class="zmdi zmdi-account-add"></i> Matrícula</a>
    <a href="#"><i class="zmdi zmdi-check-all"></i> Confirmação</a>

</li>
@endsection


