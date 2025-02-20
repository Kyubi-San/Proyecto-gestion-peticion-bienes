var form = document.getElementById("form")
const formInput = document.querySelectorAll(".form__input")

function validarCampos() {
  let pass = 0
  formInput.forEach(input => {
    if (input.value != "" && input.getAttribute("name") != "withdrawalDate") {
      pass++
    }
  });
  return pass == 7 ? true : false
}

form.addEventListener('submit', (e) =>{
    e.preventDefault();
    if (validarCampos()) {
      Swal.fire({
        text: "¿Quieres agregar este bien?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
          let xhr = new XMLHttpRequest()
          xhr.open("POST", form.action)
          xhr.send(new FormData(form))
          xhr.onload = function () {
            Swal.fire({
              title: "",
              position: "top-end",
              text: "El bien fue agregado con exito",
              showConfirmButton: false,
              icon: "success",
              timer: 1500
            });
          }
          form.reset()
        }
      });
    }    
})


