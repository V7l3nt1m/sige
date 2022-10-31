@extends('layouts.layoutsige')

@section('title', 'Definições')

@section('nome_aluno')
<div class="user__name">{{$user->name}}</div>
@endsection

@section('settings')
<a class="dropdown-item" href="/pcaadmin/perfil">Ver Perfil</a>
<a class="dropdown-item" href="/pcaadmin/definições">Configurações</a>
@endsection

@section('navbar')
<li class="navigation__sub @@variantsactive">
    <a href="#"><i class="zmdi zmdi-settings"></i> Serviços</a>

    <ul>
        <li class="navigation__sub @@variantsactive">
            <a href="#">Alunos</a>
        <ul>
            <li class="@@sidebaractive"><a href="{{route('cadasaluno')}}">Cadastrar Alunos</a></li>
            <li class="@@boxedactive"><a href="{{route('gerenciaralunos')}}">Gerenciar Alunos</a></li>
        </ul>
    </li>
    <li class="navigation__sub @@variantsactive">
        <a href="#">Funcionários</a>
    <ul>
        <li class="@@sidebaractive"><a href="{{route('funcionario')}}">Cadastrar Funcionários</a></li>
        <li class="@@boxedactive"><a href="#">Gerenciar Funcionários</a></li>
    </ul>
</li>

<li class="navigation__sub @@variantsactive">
    <a href="#">Turmas</a>
<ul>
    <li class="@@sidebaractive"><a href="{{route('turmas')}}">Cadastrar Turmas</a></li>
    <li class="@@boxedactive"><a href="{{route('gerenciarturmas')}}">Gerenciar Turmas</a></li>
</ul>
</li>
<li class="navigation__sub @@variantsactive">
<a href="#">Disciplinas</a>
<ul>
<li class="@@sidebaractive"><a href="{{route('disciplinas')}}">Cadastrar Disciplinas</a></li>
<li class="@@boxedactive"><a href="#">Gerenciar Disciplinas</a></li>
</ul>
</li>

<li class="navigation__sub @@variantsactive">
<a href="#">Classes</a>
<ul>
<li class="@@sidebaractive"><a href="{{route('classes')}}">Cadastrar Classes</a></li>
<li class="@@boxedactive"><a href="{{route('funcionario')}}">Gerenciar Classes</a></li>
</ul>
</li>
<li class="navigation__sub @@variantsactive">
<a href="#">Cursos</a>
<ul>
<li class="@@sidebaractive"><a href="{{route('cursos')}}">Cadastrar Cursos</a></li>
<li class="@@boxedactive"><a href="{{route('funcionario')}}">Gerenciar Cursos</a></li>
</ul>
</li>
        </ul>
</li>

<li class="@@typeactive"><a href="#"><i class="zmdi zmdi-money"></i> Finança</a></li>

<li class="@@widgetactive"><a href="#"><i class="zmdi zmdi-money-box"></i> Despesas</a></li>


<li class="@@widgetactive"><a href="{{route('permissoes')}}"><i class="zmdi zmdi-lock"></i></i> Permissões</a></li>

<li class="@@widgetactive"><a href="widgets.html"><i class="zmdi zmdi-account"></i> Livros de Ponto</a></li>
@endsection

