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
                        <label for="referenceId">Autenticador</label>
                        <input type="text" id="referenceId" name="referenceId" readonly class="form-control" value="{{$data->referenceId}}">
                        <small id="referenceIdHelp" class="form-text text-muted">Após o processamento da solicitação a chave de autenticação aparece aqui.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="studentId">Código Estudante</label>
                        <input type="text" id="studentId" name="studentId" class="form-control" readonly value="{{$studentData->id}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        @if ($data->studentId == 0)
                        <label for="studentName">Nome do Estudante</label>
                        <select id="studentName" name="studentName" class="form-select select-type fix-select2-height" aria-label="Informe o Estudante"></select>
                        @else
                        <label for="studentNameInput">Nome do Estudante</label>
                        <input type="text" id="studentNameInput" name="studentNameInput" readonly class="form-control" value="{{$studentData->name}}">
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="value">Valor*</label>
                        <input type="text" id="value" name="value" class="form-control" required="true" value="{{$data->getValue()}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="dueDate">Data Vencimento*</label>
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
                        <select id="status" name="status" class="form-select select-type" aria-label="Informe o Status">
                            @for ($i = 0; $i < 3; $i++)
                                <option value="{{$paimentStatusKey[$i]}}" {{ $data->status == $paimentStatusKey[$i] ? 'selected' : '' }}>{{ $paimentStatusVal[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="type">Forma de Pagamento*</label>
                        <select id="type" name="type" class="form-select" aria-label="Informe o Tipo de Cobrança">
                            @for ($i = 0; $i < 3; $i++)
                                <option value="{{$paimentTypeKey[$i]}}" {{ $data->type == $paimentTypeKey[$i] ? 'selected' : '' }}>{{ $paimentTypeVal[$i] }}</option>
                            @endfor
                        </select>
                        <small id="typeHintHelp" class="form-text text-muted" style="color: #f5c6cb!important;display: none">
                            Não é possível gerar cobrança com cartão neste momento.
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/charges" class="btn btn-warning">Voltar</a>
                </div>
                <div class="col" style="text-align: end;">
                    <button type="submit" class="btn btn-success" id="btn-post">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script >
    $(window).on('ready', function() {
        var dataType = '{{$data->type}}';
        var studentId = '{{$data->studentId}}';
        if(dataType == "bankSlip" || dataType == '') {
            $("#btn-post").attr('disabled',false);
            $("#typeHintHelp").hide();
        } else {
            $("#btn-post").attr('disabled',true)
            $("#typeHintHelp").show();
        }

        if (studentId == '0') {
            $("#studentName").prop('readonly', false);
            $('#studentName').select2({
                ajax: {
                    url: '/api/students/ajaxlist',
                    dataType: 'json'
                }
            });
        }
    });

    $("#type").on('change',function(){
        var selection = $(this).find('option:selected').text();
        if(selection == "Boleto") {
            $("#btn-post").attr('disabled',false);
            $("#typeHintHelp").hide();
        } else {
            $("#btn-post").attr('disabled',true)
            $("#typeHintHelp").show();
        }
    });

    $("#studentName").on('change',function(){
        var selection = $(this).find('option:selected').val();
        $("#studentId").val(selection);
    });

</script>

@endsection
