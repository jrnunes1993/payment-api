@extends('layouts.app')

@php
  $title = "Lista de Estudantes";
@endphp

@include('partials.head', ['title' => $title])

@section('content')
  <div>
    <h1>{{$title}}</h1>
    @foreach ($data as $student)
      <p>{{ $student->id }} - {{ $student->name }} ({{ $student->status }}) </p>
    @endforeach
  </div>  
@endsection