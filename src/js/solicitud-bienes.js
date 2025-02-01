var tipoBien = document.getElementById("tipo_bien")
var descriptionValues = document.getElementById("description-values")
var description = document.getElementById("description")


tipoBien.addEventListener("change", () =>{
    if (tipoBien.value == 'Electronico') {
        descriptionValues.innerHTML = `
            <select id="tipo-electronico" class="tipo" name="bienSpec" onchange="selectElectronico(this.value)">
                <option value="" selected disabled>Selecciona un tipo de electronico</option>
                <option value="Computadora">Computadora</option>
                <option value="accesorio">Accesorio electronico</option>
                <option value="otros">Otros...</option>
            </select>
            `        
    } else if (tipoBien.value == 'Mueble') {
        descriptionValues.innerHTML = ""
        description.innerHTML = ""
    }
})

function selectElectronico(tipoElectronico) {
    if (tipoElectronico == 'Computadora') {
        description.innerHTML = '<span>Computadora</span><input type="text" name="tipo-informacion" placeholder="Agrega mas informacion">'
    }

    if (tipoElectronico == 'accesorio') {
        description.innerHTML = '<span>Accesorio Electronico</span><input type="text" name="tipo-informacion" placeholder="Agrega mas informacion">'
    }

    if (tipoElectronico == 'otros') {
        description.innerHTML = '<input type="text" placeholder="escriba el objeto electronico"><input type="text" placeholder="Agregar mas informacion">'
    }
}

