@extends('layouts.app')

@php
    $title = "Cadastro de Estudantes";
    $message = session('message');
@endphp

@include('partials.head', ['title' => $title])

@section('content')
<div>
    <h3>{{$title}}</h3>
    @if( session('message') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form name="student-view-form" id="student-view-form" method="post" action="store">
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
                        <label for="name">Nome*</label>
                        <input type="text" id="name" name="name" maxlength="100" class="form-control" required="true" value="{{$data->name}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="id">E-Mail*</label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="50" required="true" value="{{$data->email}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Telefone*</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" required="true" value="{{$data->phoneNumber}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="id">CPF*</label>
                        <input type="text" id="document" name="document" class="form-control" maxlength="50" required="true" value="{{$data->document}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Situação*</label>
                        <select id="status" name="status" class="form-select" aria-label="Informe a Situação">
                            <option value="Registered" {{ $data->status == 'Registered' ? 'selected' : '' }}>Registrado</option>
                            <option value="Locked" {{ $data->status == 'Locked' ? 'selected' : '' }}>Trancado</option>
                            <option value="Canceled" {{ $data->status == 'Canceled' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="id">País*</label>
                        <input type="text" id="country" name="country" class="form-control" maxlength="50" required="true" value="{{$data->country}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="id">Estado*</label>
                        <select id="state" name="state" class="form-select" aria-label="Informe o Estado">
                            @for ($i = 0; $i < 27; $i++)
                                <option value="{{$postals[$i]}}" {{ $data->state == $postals[$i] ? 'selected' : '' }}>{{ $states[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Cidade*</label>
                        <input type="text" id="city" name="city" class="form-control" required="true" value="{{$data->city}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Bairro*</label>
                        <input type="text" id="locality" name="locality" class="form-control" required="true" value="{{$data->locality}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Logradouro*</label>
                        <input type="text" id="street" name="street" class="form-control" maxlength="50" required="true" value="{{$data->street}}">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="name">Número*</label>
                        <input type="number" id="number" name="number" class="form-control" required="true" value="{{$data->number}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">CEP*</label>
                        <input type="text" id="postalCode" name="postalCode" class="form-control" maxlength="50" required="true" value="{{$data->postalCode}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/students" class="btn btn-warning">Voltar</a>
                </div>
                <div class="col" style="text-align: end;">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </form>
    @if ($data->id > 0)
    <div id="sub-grid" class="container">
        <hr>
        @include('partials.chargelist', ['caption' => 'Lista de Cobranças para ' . $data->name, 'studentId' => $data->id])
    </div>
    @endif
</div>

@endsection