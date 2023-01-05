@extends('layout')
@section('header')    

@endsection

@section('main')
<header class="header">
<nav class="navbar navbar-expand-lg header-nav fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index">ShopList</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="report">Relatório</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mais
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="historic">Histórico</a></li>
            <li><a class="dropdown-item" href="settings">Configurações</a></li>
            <li><a class="dropdown-item" href="donation">Doação</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout">Sair</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
      <a href="new_list" class="btn">Nova Lista</a>
      </ul>
    </div>
  </div>
</nav>       
</header>
<br>
<br>
<br>
<br>
<br>
@if (empty($suasListas->toArray()))
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
  <div class="col-md-12 centered mx-auto" style="width: max-content;">
     <a type="submit" href="/new_list" class="btn btn-primary btn-lg">Nenhuma lista disponivel.</br>Click aqui para criar uma!</a>
  </div>
@else
@foreach($suasListas as $listas)
  <div class="col-md-12 centered mx-auto" style="width: max-content;">
     <h1>{{$listas->nome}}</h1>
  </div>
  @endforeach
@endif
@endsection