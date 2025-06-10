@extends('layouts.main')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Scan QR</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Scan QR</li>
        </ol>

        <div>
            <form action="{{ route('index.submit_qr_scan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="data">data qr:</label>
                    <input readonly type="text" id="data" name="data" value="-">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>

 
        <div id="reader"></div>
            <script src="{{ asset('assets/html5-qrcode/html5-qrcode.min.js') }}"></script>
            <script>
                // inisiasi html5QRCodeScanner
                let html5QRCodeScanner = new Html5QrcodeScanner(
                    // target id dengan nama reader, lalu sertakan juga 
                    // pengaturan untuk qrbox (tinggi, lebar, dll)
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 200,
                            height: 200,
                        },
                    }
                );

                // function yang dieksekusi ketika scanner berhasil
                // membaca suatu QR Code
                function onScanSuccess(decodedText, decodedResult) {
                    // redirect ke link hasil scan
                    // window.location.href = decodedResult.decodedText;
                    document.getElementById("data").value = decodedResult.decodedText;

                    // membersihkan scan area ketika sudah menjalankan 
                    // action diatas
                    html5QRCodeScanner.clear();
                }

                // render qr code scannernya
                html5QRCodeScanner.render(onScanSuccess);

            </script>
        
    </div>

@endsection