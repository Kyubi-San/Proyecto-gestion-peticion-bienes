var input = document.querySelectorAll('.login-input');
var form = document.getElementById('login-form');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let pass = 0;

    input.forEach((input) => {
        if (input.value == "") {
            input.style.borderLeft = "5px solid red"
        } else {
            input.style.borderLeft = "5px solid #0984e3"
            pass++
        }
    });
    
    if (pass == input.length) form.submit();
})