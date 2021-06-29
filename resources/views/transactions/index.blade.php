@extends('home')

@section('inner_content')
    <div class="card">
        <div class="card-body" style="overflow: auto;">
            <table id="datatable" class="table table-bordered" style="width: 100%">
                <thead class="bg-light">
                    <th>ID</th>
                    <th>Benefactor</th>
                    <th>Beneficiary</th>
                    <th>Amount (MMK)</th>
                    <th>Date</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    @include('admin.datatables')

    <script>
        $(document).ready(function() {
            var dataTable = $('#datatable').DataTable({
                "serverSide": true,
                "ajax": "/transactions/datatable",
                "order": [
                    [4, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, ]
                }],
                "columns": [{
                        data: "id",
                        name: "ID",
                        orderable: false,
                    },
                    {
                        data: "benefactor",
                        name: "benefactor",
                    },
                    {
                        data: "beneficiary",
                        name: "beneficiary",
                    },
                    {
                        data: "amount",
                        name: "amount",
                    },
                    {
                        data: {
                            _: "date",
                            sort: "created_at"
                        },
                        name: "created_at"
                    },
                ]
            });
        });
    </script>
@endsection
