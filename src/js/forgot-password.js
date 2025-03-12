const form = document.getElementById('login-form')
const recoverStep = document.querySelectorAll('.recover__steps')
const stepNumber = document.querySelectorAll('.recover__steps-number')
const formulario = document.querySelectorAll('.form')
const stepOne = document.getElementById('step-one')

var step = 0

recoverStep[0].addEventListener('click', () => {
    setActive(0)
    step = 0
})

recoverStep[1].addEventListener('click', () => {
    if (step > 0) {
        setActive(1)
        step = 1
    }
})

function setActive(x) {
    for (let i = 0; i < stepNumber.length; i++) {
        if (i == x) {
            stepNumber[i].classList.add('recover__steps-number--active')
            recoverStep[i].classList.add('recover__steps--active')
            formulario[i].classList.add('form--active')
        } else {
            stepNumber[i].classList.remove('recover__steps-number--active')
            recoverStep[i].classList.remove('recover__steps--active')
            formulario[i].classList.remove('form--active')
        }
    }
}

const email = document.getElementById('email')
var emailValue = ''
var idUsuario

form.addEventListener('submit', (e) => {
    e.preventDefault()
    if (email.value != '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../server/routes/verify-email.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('email=' + email.value);
        xhr.onload = function() {
            if (xhr.responseText) {
                setActive(1)
                emailValue = email.value
                const displayPregunta1 = document.getElementById('pregunta1')
                const displayPregunta2 = document.getElementById('pregunta2')
                const displayPregunta3 = document.getElementById('pregunta3')
                const preguntasSeguridad = xhr.responseText.split("-")

                const pregunta1 = preguntasSeguridad[0]
                const pregunta2 = preguntasSeguridad[1]
                const pregunta3 = preguntasSeguridad[2]
                idUsuario = preguntasSeguridad[3]

                displayPregunta1.innerText = pregunta1
                displayPregunta2.innerText = pregunta2
                displayPregunta3.innerText = pregunta3
                step = 1
            }
        }
    }
})

const securityQuestionForm = document.getElementById('security-question')
var respuesta1 = document.getElementById('respuesta1')
var respuesta2 = document.getElementById('respuesta2')
var respuesta3 = document.getElementById('respuesta3')

securityQuestionForm.addEventListener('submit', (e) => {
    e.preventDefault()
    if (respuesta1.value != '' && respuesta2.value != '' && respuesta3.value != '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../server/routes/validate-security-question.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('respuesta1=' + respuesta1.value + '&respuesta2=' + respuesta2.value + '&respuesta3=' + respuesta3.value + '&idUsuario=' + idUsuario)
        xhr.onload = function() {
            if (xhr.responseText) {
                setActive(2)
                console.log(xhr.responseText)
                step = 2
            }
        }
    }
})

const changePasswordForm = document.getElementById('change-password')
const messageError = document.getElementById('message-error')
const passwordInstruction = document.getElementById('password-instruction')
const password = document.getElementById('new-password')
const confirmPassword = document.getElementById('confirm-password')

changePasswordForm.addEventListener('submit', (e) => {
    e.preventDefault()
    if (password.value != '' && confirmPassword.value != '' && password.value == confirmPassword.value) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../server/routes/change-password.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('newPassword=' + password.value + '&confirmPassword=' + confirmPassword.value + '&email=' + emailValue)
            xhr.onload = function() {
                if (xhr.responseText) {
                    console.log(xhr.responseText)
                    window.location.href = 'login.php'
                }
            }
    }

    if (password.value != confirmPassword.value) {
        messageError.innerText = 'Las contraseñas no coinciden'
    } else {
        messageError.innerText = ''
    }
})

