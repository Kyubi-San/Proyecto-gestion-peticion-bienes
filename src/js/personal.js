const form1 = document.getElementById('formulario1');
const form2 = document.getElementById('formulario2');
const form3 = document.getElementById('formulario3');

var nombre = document.getElementById('nombre').value;
var apellido = document.getElementById('apellido').value;
var cedula = document.getElementById('cedula').value;

form3.addEventListener('submit', (e) => {
  e.preventDefault();
  if (validarInput()) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", form3.action);
    xhr.send(new FormData(form3));
    xhr.onload = function () {
      Swal.fire({
        title: "",
        text: "¡Cuenta Actualizada!",
        showConfirmButton: false,
        icon: "success",
        timer: 1500
      });
      nombre = document.getElementById('nombre').value;
      apellido = document.getElementById('apellido').value;
      cedula = document.getElementById('cedula').value;
      blockButton();
    }
  }
});

const button = document.getElementById('button');

function blockButton() {
    if (formInput[0].value != nombre || formInput[1].value != apellido || formInput[2].value != cedula) {
        button.disabled = false;
    } else {
        button.disabled = true;
    }
}

const formInput = document.querySelectorAll(".form__input");
const messageErorr = document.querySelectorAll(".form__error");

for (let i = 0; i < formInput.length; i++) {
    formInput[i].addEventListener('input', ()=> {
        blockButton();
        if (formInput[i].value != "") {
            formInput[i].classList.remove('form__input--error');
            messageErorr[i].style.display = 'none';
        } else {
            formInput[i].classList.add('form__input--error');
            messageErorr[i].style.display = 'block';
        }
    })
}

function validarInput() {
    let pass = 0
    for (let i = 0; i < formInput.length; i++) {
        if (formInput[i].value == "") {
            return false;
        } else {
            pass++
        }
    }
    return pass == formInput.length ? true : false
}