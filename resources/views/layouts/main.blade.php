<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <title>CRUD APP - @yield('title')</title>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
    </head>
    <body class="" style="background-image: url('/img/boxes_patern.jpg');
        background-repeat:repeat; background-size: 600px;"
    >
        <div class="container-fluid p-0 py-5 m-0">           
            {{-- Include Navbar --}}
            @include('panels.navbar')
            
            {{-- Include Alerts --}}
            @include('panels.alerts')
        
            {{-- Include Page Content --}}
            @yield('content')
                
            {{-- include footer --}}
            @include('panels.footer')               
        </div>
    </body>
    {{-- include default scripts --}}
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="module">
        import QrScanner from '{{ asset('js/qr-scanner.min.js') }}';
        // Hacer algo con QrScanner

        const video = document.getElementById('qr-video');
        const videoContainer = document.getElementById('video-container');
        const camHasCamera = document.getElementById('cam-has-camera');
        const camList = document.getElementById('cam-list');
        const camHasFlash = document.getElementById('cam-has-flash');
        const flashToggle = document.getElementById('flash-toggle');
        const flashState = document.getElementById('flash-state');
        const camQrResult = document.getElementById('cam-qr-result');
        const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
        const fileSelector = document.getElementById('file-selector');
        const fileQrResult = document.getElementById('file-qr-result');
    
        function setResult(label, result) {
            if (result && result.data) {
                // Si se encuentra un resultado válido, establecerlo como hipervínculo
                label.innerHTML = `<a href="${result.data}" target="_blank" class="text-decoration-none text-secondary fs-2 fw-light">Ir a tu producto</a>`;
            } else {
                // Si no se encuentra un código QR, mostrar el mensaje deseado
                label.textContent = (result && result.data === "No QR code found") ? 'No se detecta código QR' : 'No se encontró ningún código QR';
                label.classList.add('text-secondary');
            }
            camQrResultTimestamp.textContent = new Date().toString();
        }
    
        // ####### Web Cam Scanning #######
    
        const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
            onDecodeError: error => {
                camQrResult.textContent = error;
                camQrResult.style.color = 'inherit';
            },
            highlightScanRegion: true,
            highlightCodeOutline: true,
        });
    
        const updateFlashAvailability = () => {
            scanner.hasFlash().then(hasFlash => {
                camHasFlash.textContent = hasFlash;
                flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
            });
        };
    
        scanner.start().then(() => {
            updateFlashAvailability();
            // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
            // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
            // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
            // start the scanner earlier.
            QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                const option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.label;
                camList.add(option);
            }));
        });
    
        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);
    
        // for debugging
        window.scanner = scanner;
    
        document.getElementById('scan-region-highlight-style-select').addEventListener('change', (e) => {
            videoContainer.className = e.target.value;
            scanner._updateOverlay(); // reposition the highlight because style 2 sets position: relative
        });
    
        document.getElementById('show-scan-region').addEventListener('change', (e) => {
            const input = e.target;
            const label = input.parentNode;
            label.parentNode.insertBefore(scanner.$canvas, label.nextSibling);
            scanner.$canvas.style.display = input.checked ? 'block' : 'none';
        });
    
        document.getElementById('inversion-mode-select').addEventListener('change', event => {
            scanner.setInversionMode(event.target.value);
        });
    
        camList.addEventListener('change', event => {
            scanner.setCamera(event.target.value).then(updateFlashAvailability);
        });
    
        flashToggle.addEventListener('click', () => {
            scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
        });
    
        document.getElementById('start-button').addEventListener('click', () => {
            scanner.start();
        });
    
        document.getElementById('stop-button').addEventListener('click', () => {
            scanner.stop();
        });
    
        // ####### File Scanning #######
    
        fileSelector.addEventListener('change', event => {
            const file = fileSelector.files[0];
            if (!file) {
                return;
            }
            QrScanner.scanImage(file, { returnDetailedScanResult: true })
                .then(result => setResult(fileQrResult, result))
                .catch(e => setResult(fileQrResult, { data: e || 'No QR code found XXXX.' }));
        });

    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="{{ asset('js/closing-alerts.js') }}"></script>
</html>
