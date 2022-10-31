@extends('layouts.layoutsige')

@section('title', 'Tesouraria')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/tesouraria/perfil">Ver Perfil</a>
<a class="dropdown-item" href="/tesouraria/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <a href="#"><i class="zmdi zmdi-money"></i> Propinas</a>
    <a href="#"><i class="zmdi zmdi-account-add"></i> Matrícula</a>
    <a href="#"><i class="zmdi zmdi-check-all"></i> Confirmação</a>
    <a href="#"><i class="zmdi zmdi-directions-walk"></i> Estágio</a>
    <a href="#"><i class="zmdi zmdi-shopping-cart"></i> Material Escolar</a>
    <a href="#"><i class="zmdi zmdi-attachment-alt"></i> Documentos</a>
    <a href="#"><i class="zmdi zmdi-block"></i> Faltas</a>


</li>
    

@endsection
