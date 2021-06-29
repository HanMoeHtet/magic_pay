@extends('layouts.app')

@section('content')
    {{-- User Details Table --}}
    <div class="row m-0">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered d-none d-md-table m-0 mb-4">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $user->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Account Number</th>
                                <td>{{ $user->account_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered d-md-none m-0 mb-4">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="font-weight-bold mb-2">Name</div>
                                    <div>{{ $user->name }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold mb-2">Phone Number</div>
                                    <div>{{ $user->phone_number }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="font-weight-bold mb-2">Email</div>
                                    <div>{{ $user->email }}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('password_reset.edit') }}">Reset Password</a>
                </div>
            </div>
        </div>
    </div>
@endsection
