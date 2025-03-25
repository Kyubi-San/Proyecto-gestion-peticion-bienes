const form1 = document.getElementById('form1')
const form2 = document.getElementById('form2')

const changeQuestion = document.getElementById('change-question')
const changePassword = document.getElementById('change-password')

changeQuestion.addEventListener('click', () => {
    form2.classList.add('hidden')
    form1.classList.remove('hidden')
    changeQuestion.classList.add('menu-selection__button--selected')
    changePassword.classList.remove('menu-selection__button--selected')

})

changePassword.addEventListener('click', () => {
    form1.classList.add('hidden')
    form2.classList.remove('hidden')
    changePassword.classList.add('menu-selection__button--selected')
    changeQuestion.classList.remove('menu-selection__button--selected')
})

const messageError = document.getElementById('message-error')
const newPassword = document.getElementById('new-password')
const newPasswordError = document.getElementById('new-password-error')
const confirmPassword = document.getElementById('confirm-password')

function validatePassword() {
    if (newPassword.value == confirmPassword.value) {
        newPassword.style.borderBottom = "1px solid #bdc3c7"
        confirmPassword.style.borderBottom = "1px solid #bdc3c7"
        newPasswordError.innerHTML = ""
        if (newPassword.value.length < 8) {
            newPasswordError.innerHTML = "La contraseña debe contener un minimo de 8 caracteres"         
        } else {
            return true  
        }
    } else {
        newPassword.style.borderBottom = "1px solid red"
        confirmPassword.style.borderBottom = "1px solid red"
        newPasswordError.innerHTML = "Las contraseñas no coinciden"
        return false     
    }
}

newPassword.addEventListener('input', validatePassword)
confirmPassword.addEventListener('input', validatePassword)
const passwordError = document.getElementById('password-error')

form2.addEventListener('submit', (e) => {
    e.preventDefault()
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../server/routes/verify_password.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.send('password=' + document.getElementById('password').value)
    xhr.onload = function () {
        if (xhr.responseText === 'true') {
            passwordError.innerHTML = ""
            if (validatePassword()) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    width: "450",
                    color: "#636e72",
                    customClass: {
                        popup: 'custom-font-size'
                    },
                    title: "Tu contraseña fue cambiada con exito",
                    showConfirmButton: false,
                    timer: 1500
                  })
                  form2.reset()
            }
          } else {
            passwordError.innerHTML = "Contraseña incorrecta";
          }
    }
})