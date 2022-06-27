@extends('layouts.app')

@php
  $title = "Lista de Estudantes";
@endphp

@include('partials.head', ['title' => $title])

@section('content')
  <div>
    <h3>{{$title}}</h3>
    <!-- <div class="container">
      <div class="row">
        <div class="col-2">
          Código
        </div>
        <div class="col">
          Nome
        </div>
        <div class="col">
          E-Mail
        </div>
        <div class="col">
          Situação
        </div>
      </div>
      @foreach ($data as $student)
        <div class="row">
          <div class="col-2">{{ $student->id }}</div>
          <div class="col">{{ $student->name }}</div>
          <div class="col">{{ $student->email }}</div>
          <div class="col">{{ $student->getStatusStr() }}</div>
        </div>
      @endforeach
    </div>    
  </div> -->

  <hr>
  <table id="datatable-students" class="table table-striped table-hover table-bordered row-border order-column" style="width: 100%;">
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Situação</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $student)
      <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->getStatusStr() }}</td>
      </tr>
    </tbody>
    @endforeach 
  </table>
@endsection

