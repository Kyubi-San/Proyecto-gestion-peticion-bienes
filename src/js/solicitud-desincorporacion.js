document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById("form")

    document.getElementById('tipo_bien').addEventListener('change', function() {
        var selectedValue = this.value;

        // Make an AJAX request to fetch data based on the selected value
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../server/routes/retiro-bien.php?id=' + selectedValue, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('result').innerHTML = xhr.responseText;
                } else {
                    console.error('Error en la consulta: ' + xhr.statusText);
                }
            }
        };
        
        xhr.send();
    });

    const messageError = document.querySelector(".message-error")

    document.getElementById('form').onsubmit = function(e) {
      e.preventDefault();
      const password = document.getElementById('password').value;
  
      // Enviar la contraseña al servidor
      verifyPassword(password);
  };
  
  function verifyPassword(password) {
      const xhr = new XMLHttpRequest();
      xhr.open('POST', '../server/routes/verify_password.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send('password=' + password);
      xhr.onload = function() {
        if (xhr.responseText === 'true') {
          messageError.innerHTML = '';
          Swal.fire({
            text: "¿Quieres desincorporar este bien?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Aceptar",
          }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                  title: "",
                  position: "top-end",
                  text: "El bien fue retirado con exito",
                  showConfirmButton: false,
                  icon: "success",
                  timer: 1500
                });
              form.submit() 
            }
          });
        } else {
          messageError.innerHTML = "Contraseña incorrecta";
        }
      }
  }
});