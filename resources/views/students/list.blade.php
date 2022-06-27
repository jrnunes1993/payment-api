@extends('layouts.app')

@php
  $title = "Lista de Estudantes";
@endphp

@include('partials.head', ['title' => $title])

@section('content')
  <div>
    <h3>{{$title}}</h3>
    <table class="table table-bordered data-table">
      <thead>
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>E-Mail</th>
          <th>Situação</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <script type="text/javascript">
  $(function () {    
    var table = $('.data-table').DataTable({
        // processing: true,
        serverSide: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
        },
        ajax: "{{ route('db.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'statusStr', name: 'statusStr'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
  
@endsection



