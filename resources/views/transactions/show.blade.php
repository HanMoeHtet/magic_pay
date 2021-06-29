@extends('home')

@section('inner_content')
    <div class="card">
        <div class="card-header">
            {{ __("Transaction ID ($transaction->id)") }}
        </div>
        <div class="card-body">
            <h5>Details</h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="w-25">Date</th>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>MMK {{ $amount }}</td>
                    </tr>
                </tbody>
            </table>

            <h5>From</h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="w-25">Name</th>
                        <td>{{ $benefactor->name }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $benefactor->phone_number }}</td>
                    </tr>
                </tbody>
            </table>

            <h5>To</h5>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="w-25">Name</th>
                        <td>{{ $beneficiary->name }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $beneficiary->phone_number }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
