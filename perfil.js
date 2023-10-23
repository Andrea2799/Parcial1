// Event listener para el botón "Cambiar fondo"
document.getElementById("cambiar-fondo").addEventListener("click", function() {
    // Aquí puedes agregar la lógica para permitir al usuario cargar una imagen de fondo
    // Puedes usar una biblioteca de carga de imágenes o una función personalizada para esto
    // Por ejemplo, podrías mostrar un cuadro de diálogo para que el usuario seleccione una imagen
    // Luego, cambia el fondo utilizando CSS.
    // Ejemplo:
    document.querySelector(".perfil-usuario-portada").style.backgroundImage = "url('nueva-imagen-de-fondo.jpg')";
});

// Event listener para el botón "Cambiar foto de perfil"
document.getElementById("cambiar-avatar").addEventListener("change", function() {
    // Este evento se activa cuando el usuario selecciona una nueva imagen para el perfil
    // Aquí puedes cargar la imagen seleccionada y cambiar la imagen de perfil
    const avatarInput = document.getElementById("cambiar-avatar");
    const avatarImage = document.getElementById("perfil-img");

    if (avatarInput.files && avatarInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            avatarImage.src = e.target.result;
        };

        reader.readAsDataURL(avatarInput.files[0]);
    }
});
