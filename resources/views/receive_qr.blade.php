@extends('home')

@section('inner_content')
    <div class="card">
        <div class="card-header">Scan To Pay</div>
        <div class="card-body d-flex align-items-center flex-column">

            <button class="btn btn-primary mb-4" type="button" data-toggle="collapse" data-target="#receive_qr_form"
                aria-expanded="false" aria-controls="receive_qr_form">Add Amount</button>

            <form action="{{ route('receive_qr') }}" method="GET" class="w-100 collapse @error('amount') show @enderror"
                id="receive_qr_form">
                @csrf
                <div class="form-group row">
                    <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                    <div class="col-md-6">
                        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror"
                            name="amount">
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" onclick="resetAmount()">
                            {{ __('Reset Amount') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Set Amount') }}
                        </button>
                    </div>
                </div>
                <hr class="w-75" />
            </form>

            <table class="table table-bordered w-75">
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $user->phone_number }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>{{ $amount ? $amount : 'Set by benefactor' }}</td>
                </tr>
            </table>

            <img src="data:image/png;base64,{{ $qr_code }}" style="width: 200px;">

            <a class="btn btn-primary" href="data:image/png;base64,{{ $qr_code }}"
                download="Magic_Pay_QR_Code">Download
                PNG</a>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function resetAmount() {
            receive_qr_form.amount.value = null;
            receive_qr_form.submit();
        }
    </script>
@endsection
