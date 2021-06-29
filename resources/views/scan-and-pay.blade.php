@extends('home')

@section('inner_content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach

    <div class="card">
        <div class="card-body d-flex flex-column align-items-center">
            <img src="/assets/images/scan_and_pay.jpg" alt="Scan and pay">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scanModal">Scan & Pay</button>
        </div>
    </div>

    <!-- Scan Modal -->
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan & Pay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <video id="scanner" width="250px"></video>
                </div>
            </div>
        </div>
    </div>

    <form name="qrPayForm" id="qrPayForm">
        @csrf
        <input type="hidden" name="phone_number">
        <input type="hidden" name="amount">
    </form>

@endsection

@section('scripts')
    <script type="module">
        import QrScanner from '/js/qr-scanner.min.js';
        QrScanner.WORKER_PATH = '/js/qr-scanner-worker.min.js';
        const qrScanner = new QrScanner(scanner, result => {
            const {
                amount,
                phone_number
            } = JSON.parse(result);
            if (amount === 0) {
                qrPayForm.setAttribute('method', 'GET');
                qrPayForm.setAttribute('action', "{{ route('transfer.show') }}");
                qrPayForm.phone_number.value = phone_number;
            } else {
                qrPayForm.setAttribute('method', 'POST');
                qrPayForm.setAttribute('action', "{{ route('transfer.confirm') }}");
                qrPayForm.phone_number.value = phone_number;
                qrPayForm.amount.value = amount;
            }
            qrPayForm.submit();
            qrScanner.stop();
        });

        $('#scanModal').on('show.bs.modal', function() {
            qrScanner.start();
        })

        $('#scanModal').on('hide.bs.modal', function() {
            qrScanner.stop();
        })
    </script>
@endsection
