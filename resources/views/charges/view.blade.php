@extends('layouts.app')

@php
    $title = "Cadastro de Cobranças";
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
    <form name="charge-view-form" id="charge-view-form" method="post" action="store">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="id">Código</label>
                        <input type="text" id="id" name="id" class="form-control" readonly value="{{$data->id}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Autenticador</label>
                        <input type="text" id="referenceId" name="referenceId" readonly class="form-control" value="{{$data->referenceId}}">
                        <small id="emailHelp" class="form-text text-muted">Após o processamento da solicitação a chave de autenticação aparece aqui.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="id">Código Estudante</label>
                        <input type="text" id="studentId" name="studentId" class="form-control" readonly value="{{$studentData->id}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nome do Estudante</label>
                        <input type="text" id="studentName" name="studentName" readonly class="form-control" value="{{$studentData->name}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="id">Valor*</label>
                        <input type="text" id="value" name="value" class="form-control" required="true" value="{{$data->getValue()}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Data Vencimento*</label>
                        <input type="text" id="dueDate" name="dueDate" required="true" class="form-control" value="{{$data->getDueDate()}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="paidedAt">Data Pagamento</label>
                        <input type="text" id="paidedAt" name="paidedAt" class="form-control" value="{{$data->getPaidedAt()}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="status">Status*</label>
                        <select id="status" name="status" class="form-select" aria-label="Informe o Status">
                            @for ($i = 0; $i < 3; $i++)
                                <option value="{{$paimentStatusKey[$i]}}" {{ $data->status == $paimentStatusKey[$i] ? 'selected' : '' }}>{{ $paimentStatusVal[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="type">Forma de Pagamento*</label>
                        <select id="type" name="type" class="form-select" aria-label="Informe o Status">
                            @for ($i = 0; $i < 3; $i++)
                                <option value="{{$paimentTypeKey[$i]}}" {{ $data->type == $paimentTypeKey[$i] ? 'selected' : '' }}>{{ $paimentTypeVal[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/charges" class="btn btn-warning">Voltar</a>
                </div>
                <div class="col" style="text-align: end;">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection