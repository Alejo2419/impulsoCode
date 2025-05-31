document.getElementById("contactForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita que la página se recargue

    let formData = new FormData(this);

    fetch('/impulsoweb/controller/enviar.php', {
        method: "POST",
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                Swal.fire({
                    title: "¡Mensaje enviado!",
                    text: "Te contactaremos pronto.",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                });
                document.getElementById("contactForm").reset(); // Limpia el formulario
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al enviar el mensaje. Inténtalo de nuevo.",
                    icon: "error",
                    confirmButtonText: "Cerrar"
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                title: "Error",
                text: "No se pudo enviar el mensaje.",
                icon: "error",
                confirmButtonText: "Cerrar"
            });
        });
});
