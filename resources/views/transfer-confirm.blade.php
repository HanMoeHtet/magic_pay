@extends('home')

@section('inner_content')
    <div class="card">
        <div class="card-header">
            {{ __('Confirm Transfer') }}
        </div>
        <div class="card-body">
            <form id="transfer-form" action="{{ route('transfer.store', $beneficiary) }}" method="POST">
                @csrf

                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="beneficiary_id" value="{{ $beneficiary->id }}">

                <h5>Details</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="w-25">Amount</th>
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

                <div class="form-group row mb-0 px-4 mt-1">
                    <div class="col-6">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            {{ __('Back') }}
                        </a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary float-right">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
