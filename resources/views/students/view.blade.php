@extends('layouts.app')

@php
  $title = "Cadastro de Estudantes";
@endphp

@include('partials.head', ['title' => $title])

@section('content')
  <div>
    <h3>{{$title}}</h3>
    <form name="student-view-form" id="student-view-form" method="post" action="{{url('store-form')}}">
      @csrf
      <div class="container">
        <div class="row">
          <div class="col-2">
            <div class="form-group">
              <label for="id">Código</label>
              <input type="text" id="id" name="id" class="form-control" required="" readonly value="{{$data->id}}">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" id="name" name="name" class="form-control" required="true" value="{{$data->name}}">
            </div>
          </div>
        </div>            



        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>

  </div>
  
@endsection



