document.addEventListener("DOMContentLoaded", function () {
    // Obtiene referencias a los elementos relevantes
    const dropdown = document.getElementById("calendarioDropdown");
    const dropdownMenu = document.getElementById("calendarioMenu");

    // Agrega un evento de clic al elemento dropdown para gestionar el despliegue
    dropdown.addEventListener("click", function () {
        // Alternar la visibilidad del menú desplegable
        dropdownMenu.classList.toggle("show");

        // Cierra otros menús desplegables si están abiertos
        const allDropdowns = document.querySelectorAll(".dropdown-menu");
        allDropdowns.forEach(function (menu) {
            if (menu !== dropdownMenu) {
                menu.classList.remove("show");
            }
        });
    });

    // Cierra el menú desplegable si se hace clic fuera de él
    document.addEventListener("click", function (event) {
        if (!dropdown.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});
