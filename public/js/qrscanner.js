const video = document.getElementById('video');
const startButton = document.getElementById('startButton');

// Accede a la cámara y comienza el escaneo de QR
function startScan() {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(stream => {
            video.srcObject = stream;
            const qrScanner = newQRScanner(video, result => {
                console.log('QR code detected:', result);
                // Aquí puedes procesar el código QR detectado, por ejemplo, enviarlo a un controlador de Laravel para su procesamiento
            });
            qrScanner.start();
        })
        .catch(error => {
            console.error('Error al acceder a la cámara:', error);
            alert('Error al acceder a la cámara. Asegúrate de permitir el acceso a la cámara.');
        });
    } else {
        console.log('no se puede acceder a la camara');
    }
}

// Evento de clic para iniciar el escaneo de QR
startButton.addEventListener('click', startScan);
