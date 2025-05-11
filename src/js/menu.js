var bienes = document.getElementById("menu-estate")
var bienesItem = document.querySelector(".menu__item-estate")

var solicitudes = document.getElementById("menu-request")
var solicitudesItem = document.querySelector(".menu__item-request")

var usuarios = document.getElementById("menu-user")
var usuariosItem = document.querySelector(".menu__item-user")

function deployItem(menuItem, deploy) {
    let iconDeploy = document.querySelectorAll(".menu__item-iconDeploy")
    var estilo = window.getComputedStyle(menuItem);
    if (estilo.display == "flex") {
        menuItem.style.display = "none"
        iconDeploy[deploy].classList.remove("menu__item-iconDeployed")
    } else {
        menuItem.style.display = "flex"
        iconDeploy[deploy].classList.add("menu__item-iconDeployed")
    }
}

bienes.addEventListener("click", () =>{
    deployItem(bienesItem, 1)
})

solicitudes.addEventListener("click", () =>{
    deployItem(solicitudesItem, 0)
})

usuarios.addEventListener("click", () =>{
    deployItem(usuariosItem, 2)
})


