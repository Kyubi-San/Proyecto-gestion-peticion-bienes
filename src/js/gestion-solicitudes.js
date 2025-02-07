var form = document.getElementById("form")

form.addEventListener('submit', (e) =>{
    const currentURL = window.location.pathname
    let alertText = ""
    if (currentURL == '/sistema-gestion-peticion-bienes/Proyecto-gestion-peticion-bienes/src/gestion-solicitudes.php') {
      alertText = "Quieres aceptar esta solicitud de bien";
    } else {
      alertText = "Quieres rechazar esta solicitud de bien";
    }
    e.preventDefault();
    Swal.fire({
        title: "¿Estas seguro?",
        text: alertText,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "",
            text: "Se acepto la solicitud",
            showConfirmButton: false,
            icon: "success",
            timer: 1500
          });
        }
      });
})