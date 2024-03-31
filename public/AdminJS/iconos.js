const icon = document.getElementById('icon');

// Función para simular una vibración suave
function vibrarIcono() {
    icon.style.transform = 'translateY(5px)'; // Desplazar 5px hacia abajo
    setTimeout(() => {
        icon.style.transform = 'none'; // Revertir la transformación
    }, 200); // Duración de la vibración (0.2 segundos)
}

// Llamar a la función de vibración cada 3 segundos
setInterval(vibrarIcono, 3000);