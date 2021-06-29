@extends('layouts.app')

@section('content')
    <div class="row m-0">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mb-4 mb-md-0">
                            <div class="d-flex flex-column">
                                <div class="mb-2">{{ $user->name }}</div>
                                <div>{{ $user->phone_number }}</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="d-flex align-items-center justify-content-center balance">
                                <span class="text-muted mr-3">MMK</span>
                                <span class="text-muted">{{ $user->balance }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @section('inner_content')
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 pay-option mb-4">
                    <div class="card">
                        <a href="{{ route('transfer.show') }}" class="btn btn-light card-body d-flex">
                            <img src="/assets/images/money-transfer.png" alt="Transfer">
                            <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                                <span>Transfer</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 pay-option mb-4">
                    <div class="card">
                        <a href="{{ route('scan_and_pay') }}" class="btn btn-light d-flex card-body">
                            <img src="/assets/images/qr-code-scan.png" alt="Transfer">
                            <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                                <span>Scan & Pay</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 pay-option mb-4">
                    <div class="card">
                        <a href="{{ route('receive_qr') }}" class="btn btn-light card-body d-flex">
                            <img src="/assets/images/qr-code.png" alt="Transfer">
                            <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                                <span>Receive</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @show
    </div>
</div>
@endsection
