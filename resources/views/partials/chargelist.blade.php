<div>
  <h3>{{$caption}}</h3>
  <table class="table table-bordered data-table">
    <thead>
      <tr>
        <th>Código</th>
        <th>Cód. Estudante</th>
        <th>Nome Estudante</th>
        <th>Vencimento</th>
        <th>Valor</th>
        <th>Status</th>
        <th>Tipo</th>
        <th>
          <div class="center">
            <a href="/charges/0" class="edit btn btn-primary btn-sm">Novo</a>
          </div>
        </th>
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
      ajax: "{{ route('charge.index') }}",
      columns: [
          {data: 'id', name: 'id'},
          {data: 'studentId', name: 'studentId'},
          {data: 'studentName', name: 'studentName'},
          {data: 'dueDate', name: 'dueDate', type: 'date'},
          {data: 'valueFmt', name: 'valueFmt', type: 'num-fmt'},
          {data: 'statusStr', name: 'statusStr'},
          {data: 'typeStr', name: 'typeStr'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});
</script>