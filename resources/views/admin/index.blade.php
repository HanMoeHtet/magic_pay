@extends('layouts.admin.app')

@section('title')
    Admin Users
@endsection

@section('content')

    <div class="py-3">
        <a href="{{ route('dashboard.admins.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i>
            <span>Create</span>
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="datatable" class="table table-bordered">
                <thead class="bg-light">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>IP address</th>
                    <th>User Agent</th>
                    <th style="width: 160px;">Actions</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var dataTable = $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/dashboard/admins/datatable",
                "columns": [{
                        data: "id",
                        name: "ID",
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "email",
                        name: "email",
                    },
                    {
                        data: "ip",
                        name: "ip",
                    },
                    {
                        data: "user_agent",
                        name: "user_agent"
                    },
                    {
                        data: "actions",
                        name: 'actions',
                    },

                ]
            });
            window.dataTable = dataTable;
        });
    </script>

    <script>
        function deleteAdmin(el) {
            const url = el.dataset.url;

            Swal.fire({
                title: 'Are you sure you want to delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await axios.delete(url)
                    dataTable.ajax.reload();
                }
            })
        }
    </script>

    @include('admin.datatables')

@endsection
