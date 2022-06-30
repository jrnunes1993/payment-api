<div>
    <h3>{{$caption}}</h3>
    <table class="fix-responsible table table-bordered data-table">
        <thead>
            <tr>
                <th>Código</th>
                @if ($studentId == 0)
                <th>Cód. Estudante</th>
                <th>Nome Estudante</th>
                @else
                <th>Autenticador</th>
                @endif
                <th>Vencimento</th>
                <th>Pagamento</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Tipo</th>
                <th>
                    <div class="center">
                        <a href="/charges/form/0" class="edit btn btn-success btn-sm">Novo</a>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function() {
        var studentId = '{{$studentId}}';
        var colData = [
            {data: 'id', name: 'id'},
            {data: 'studentId', name: 'studentId'},
            {data: 'studentName', name: 'studentName'},
            {data: 'dueDate', name: 'dueDate', type: 'date'},
            {data: 'paidedAt', name: 'paidedAt', type: 'date'},
            {data: 'valueFmt', name: 'valueFmt', type: 'num-fmt'},
            {data: 'statusStr', name: 'statusStr'},
            {data: 'typeStr', name: 'typeStr'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];

        if (studentId != 0) {
            colData = colData.filter(function(val) {
                return val['data'] !== 'studentId' && val['data'] !== 'studentName';
            });
            colData.splice(1, 0, {
                data: 'referenceId',
                name: 'referenceId'
            });
        }
        var table = $('.data-table').DataTable({
            // processing: true,
            serverSide: true,
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            },
            ajax: "{{ route('charge.datatable', ['studentId' => $studentId]) }}",
            columns: colData
        });
    });
</script>