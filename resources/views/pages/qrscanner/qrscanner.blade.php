@extends('layouts.main')

@section('title', 'QR SCANNER')

@section('content')
    <div class="pt-5 mt-5 px-3 justify-content-center">
        <div class="card mb-3 px-0 mx-auto animated fadeInDown shadow" style="max-width: 600px;">
            <div class="row g-0 mx-0 p-0">
                <div class="card-header">
                    <h1 class="text-center text-secondary fw-light"> 
                       ESCÁNER QR
                    </h1>
                </div>
                <div class="card-body">
                    <div class="text-center d-flex flex-column justify-content-center">
                        <video class="mx-auto" id="qr-video" width="300" height="200" autoplay></video>
                        <span id="cam-qr-result" style="color: teal;">No se detecta código QR</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection