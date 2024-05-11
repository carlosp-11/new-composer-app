var alerta = document.getElementById('miAlerta');

// Configura un temporizador para que la alerta desaparezca después de 10 segundos
if (alerta) {
    setTimeout(function() {
        // Oculta la alerta estableciendo su estilo de visualización en "none"
        alerta.style.display = 'none';
    }, 60000);
}