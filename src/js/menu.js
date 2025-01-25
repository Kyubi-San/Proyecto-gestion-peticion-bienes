var bienes = document.getElementById("menu-estate")
var bienesItem = document.querySelectorAll(".menu__item-estate")

var solicitudes = document.getElementById("menu-request")
var solicitudesItem = document.querySelectorAll(".menu__item-request")

var usuarios = document.getElementById("menu-user")
var usuariosItem = document.querySelectorAll(".menu__item-user")

function deployItem(menuItem, deploy) {
    let iconDeploy = document.querySelectorAll(".menu__item-iconDeploy")

    for (let i = 0; i < menuItem.length; i++) {
        menuItem[i].classList.toggle("menu__item--active")
    }
    iconDeploy[deploy].classList.toggle("menu__item-iconDeployed")
}

bienes.addEventListener("click", () =>{
    deployItem(bienesItem, 0)
})

solicitudes.addEventListener("click", () =>{
    deployItem(solicitudesItem, 1)
})

usuarios.addEventListener("click", () =>{
    deployItem(usuariosItem, 2)
})


