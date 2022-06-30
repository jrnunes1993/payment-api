@extends('layouts.app')

@php
  $title = "Lista de Cobranças";
@endphp

@include('partials.head', ['title' => $title])

@section('content')

  @include('partials.chargelist', ['caption' => $title, 'studentId' => 0])

@endsection
