var input = document.querySelectorAll('.login-input');
var input2 = document.querySelectorAll('.login-input2');
var input3 = document.querySelectorAll('.login-input3')

var inputButton = document.getElementById('login-button');
var password = document.getElementById('password');
var confirmPassword = document.getElementById('confirm-password');
var confirmPasswordError = document.getElementById('confirm-password-error');
var inputError = document.querySelectorAll('.login-input-error');
var inputError2 = document.querySelectorAll('.login-input-error2');
var inputError3 = document.querySelectorAll('.login-input-error3')

var loginBack = document.getElementById('login-back')

var greeting = document.getElementById('login-greeting');
var tip = document.getElementById('login-tip')

var form = document.getElementById('login-form');

// Funcion para validar si los input no se encuentran vacios

function validateInput(input, inputError) {
    let pass = 0;

    for (let i = 0; i < input.length; i++) {        
        if (input[i].value != "") {
            pass++
        }
    }
    return pass
}

function showError(input, inputError) {
    for (let i = 0; i < input.length; i++) {
        let campo = input[i].getAttribute('name')
        
        if (input[i].value != "") {
            input[i].style.borderLeft = "5px solid #0984e3"
            inputError[i].innerHTML = '';
        } else {
            input[i].style.borderLeft = "5px solid red"
            inputError[i].innerHTML = 'Ingresa tu ' + campo;
        }
    }
}

// Funcion para validar si la confirmacion y la contraseña son iguales

function validatePassword(password, confirmPassword) {
    if (password.value == confirmPassword.value) {
        password.style.borderLeft = "5px solid #0984e3"
        confirmPassword.style.borderLeft = "5px solid #0984e3"
        return true  

    } else {
        password.style.borderLeft = "5px solid red"
        confirmPassword.style.borderLeft = "5px solid red"
        confirmPasswordError.innerHTML = "Las contraseñas no coinciden"
        return false     
    }
}

// Funcion para ocultar los input

function ocultarInput(input, inputError) {
    for (let i = 0; i < input.length; i++) {
        if (!input[i].hasAttribute('hidden')) {
            input[i].setAttribute('hidden', true)
            inputError[i].setAttribute('hidden', true)
        }
    }
}

// Mostrar los input

function mostrarInput(input, inputError) {
    for (let i = 0; i < input.length; i++) {
        if (input[i].hasAttribute('hidden')) {
            input[i].removeAttribute('hidden')
            inputError[i].removeAttribute('hidden')
            loginBack.removeAttribute('hidden')
        } else {
            return true;
        }
    }
}

// Envio de formulario

form.addEventListener('submit', (e) => {
    e.preventDefault();

    pass = validateInput(input, inputError)
    showError(input, inputError)

    validatePassword(password, confirmPassword)
    validateInput(input, inputError)
    
    if (pass == input.length && validatePassword(password, confirmPassword)) {
        let pass2 = validateInput(input2, inputError2)
        let pass3 = validateInput(input3, inputError3)

        greeting.innerHTML = "¡Ya casi esta listo!"
        tip.innerHTML = "Haz click si quieres volver atras"
        inputButton.innerHTML = "Continuar"
        
        ocultarInput(input, inputError)

        if (pass2 == input2.length) {
            if (mostrarInput(input3, inputError3)) {
                if (pass3 == input3.length) {
                    form.submit()
                } else {
                    showError(input3, inputError3)
                }
            } else {
                ocultarInput(input2, inputError2)
            }
        } else {
            if (mostrarInput(input2, inputError2)) {
                showError(input2, inputError2)
            }
        }
    }
})

function retroceder() {
    ocultarInput(input2, inputError2)
    mostrarInput(input, inputError)
    loginBack.setAttribute('hidden', true)
    greeting.innerHTML = "¿ERES NUEVO?"
    tip.innerHTML = "Crea una cuenta para ingresar al sistema!"
}