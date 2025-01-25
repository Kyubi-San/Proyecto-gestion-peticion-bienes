var form = document.getElementById("form")

form.addEventListener('submit', (e) =>{
    e.preventDefault();
    Swal.fire({
        title: "¿Estas seguro?",
        text: "Quieres aceptar esta solicitud de bien",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar"
      }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
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