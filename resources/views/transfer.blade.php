@extends('home')

@section('inner_content')
    <div class="card">
        <div class="card-header">
            {{ __('Transfer') }}
        </div>
        <div class="card-body">
            <form id="transfer-form" action="{{ route('transfer.confirm') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="phone_number"
                        class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                            name="phone_number" value="{{ old('phone_number') }}" required autocomplete="tel">

                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount (MMK)') }}</label>

                    <div class="col-md-6">
                        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror"
                            name="amount" required autocomplete="off">

                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Continue') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\TransferConfirmRequest', '#transfer-form') !!}
@endsection
