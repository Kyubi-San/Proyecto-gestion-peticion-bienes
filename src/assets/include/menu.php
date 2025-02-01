<?php

require '../server/db.php';

function isActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'menu__item--this' : '';
}
?>

<style>
:root {
    --menu-color: #f5f6fa;
    --menu-color-secondary: #2d3436;
}

.menu {
    border-radius: 10px 0px 0px 10px;
    display: flex;
    flex-direction: column;
    position: relative;
    color: black;
    grid-area: menu;
    background: var(--menu-color);
    border-right: #dfe6e9 1px solid;
    max-height: 100vh; /* Altura máxima de la ventana */
    overflow-y: auto; /* Habilitar desplazamiento vertical */
}

.menu h3 {
    color: #2980b9;
}

.menu__footer {
    padding: .5em 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1em;
    border-top: 1px solid #dfe6e9;
    position: relative;
    flex-shrink: 0; /* Evitar que el footer se reduzca */
}

.menu__footer--hidden {
    display: none;
}

.menu__footer--title {
    font-size: 10px;
    color: var(--menu-color-secondary);
}

.menu__logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.menu__user--img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.menu__nav {
    display: flex;
    flex-direction: column;
    gap: 1em;
    height: 100%;
    margin: 1em;
    flex-grow: 1; /* Permitir que el contenedor crezca para llenar el espacio disponible */
    overflow-y: auto; /* Habilitar desplazamiento vertical */
}

.menu__item {
    text-decoration: none;
    color: var(--menu-color-secondary);
    display: flex;
    cursor: pointer;
    display: flex;
    padding: .8em;
    justify-content: left;
    width: 91%;
    border-radius: 10px;
    user-select: none;
}

.menu__item--selectable {
    justify-content: space-between;
}

.menu__item--this {
    color: #0984e3;
}

.menu__item span {
    margin: 0 1em;
}

.menu__item:hover {
    background-color: #b2bec3;
}

.menu__item-estate, .menu__item-request, .menu__item-user {
    display: none;
}

.menu__item-iconDeploy {
    transition: .3s all;
}

.menu__item-iconDeployed {
    transform: rotate(90deg);
}

.menu__item--active {
    display: block;
}


</style>
<aside class="menu">
            <nav class="menu__nav">
                <h3>Panel General</h3>
                <a href="./index.php" class="menu__item <?php echo isActive('index.php');?>">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
                <a href="#" class="menu__item menu__item--selectable" id="menu-estate">
                    <div>
                        <i class="fas fa-box"></i>
                        <span>Bienes</span>
                    </div>  
                    <i class="fa-solid fa-chevron-right menu__item-iconDeploy"></i>
                </a>
                <a href="mis-bienes.php" id="menu-estate" class="menu__item menu__item-estate <?php echo isActive('mis-bienes.php');?>">
                    <span>Mis Bienes</span>
                </a>
                <a href="gestion-bienes.php" id="menu-estate" class="menu__item menu__item-estate">
                    <span>Bienes desincorporados</span>
                </a>
                <?php if ($records['admin'] >= 1):?>
                    <a href="agregar-bien.php" class="menu__item menu__item-estate <?php echo isActive('agregar-bien.php');?>">
                        <span>Agregar Bienes</span>
                    </a>
                    <a href="lista-bienes.php" class="menu__item menu__item-estate <?php echo isActive('lista-bienes.php');?>">
                        <span>Lista de Bienes</span>
                    </a>
                <?php endif; ?>
                <a href="#" id="menu-request" class="menu__item menu__item--selectable">
                    <div>
                        <i class="fas fa-file-alt"></i>
                        <span>Solicitudes</span>
                    </div>
                    <i class="fa-solid fa-chevron-right menu__item-iconDeploy"></i>
                </a>
                <a href="mis-solicitudes.php" class="menu__item menu__item-request <?php echo isActive('mis-solicitudes.php');?>">
                    <span>Mis Solicitudes</span>
                </a>
                <a href="solicitud-bienes.php" class="menu__item menu__item-request  <?php echo isActive('solicitud-bienes.php');?>">
                    <span>Solicitar Bien</span>
                </a>
                <a href="solicitud-bienes.php" class="menu__item menu__item-request">
                    <span>Solicitar retiro de bien</span>
                </a>
                <?php if ($records['admin'] >= 1):?>
                    <a href="lista-solicitudes.php" class="menu__item menu__item-request <?php echo isActive('lista-solicitudes.php');?>">
                        <span>Lista de Solicitudes</span>
                    </a>
                    <a href="solicitud-bienes.php" class="menu__item menu__item-request">
                        <span>Solicitudes Rechazadas</span>
                    </a>
                    <a href="solicitud-bienes.php" class="menu__item menu__item-request">
                        <span>Solicitudes de retiro</span>
                    </a>
                <?php endif; ?>
                <h3>Configuracion</h3>

                <a href="#" id="menu-user" class="menu__item menu__item--selectable">
                    <div>
                        <i class="fas fa-user"></i>
                        <span>Usuarios</span>
                    </div>
                    <i class="fa-solid fa-chevron-right menu__item-iconDeploy"></i>
                </a>
                <a href="register.php" class="menu__item menu__item-user">
                    <span>Datos Personales</span>
                </a>
                <a href="preguntas-seguridad.php" class="menu__item menu__item-user <?php echo isActive('preguntas-seguridad.php');?>">
                    <span>Preguntas de seguridad</span>
                </a>
                <?php if ($records['admin'] >= 1):?>
                    <a href="register.php" class="menu__item menu__item-user">
                        <span>Registrar Dependencia</span>
                    </a>
                    <a href="administrar-usuarios.php" class="menu__item menu__item-user <?php echo isActive('administrar-usuarios.php');?>">
                        <span>Administrar usuarios</span>
                    </a>
                <?php endif; ?>

                <a href="logout.php" class="menu__item">
                    <i class="fa-solid fa-power-off"></i>
                    <span>Cerrar Sesion</span>
                </a>
            </nav>
            <div class="menu__footer">
                <img src="assets/logo-sistema.jpg" alt="Logo Del sistema" class="menu__logo">
                <div class="menu__footer--title">
                    <h1>Contraloria de Guanipa</h1>
                    <h2>Gestion y solicitud de bienes</h2>
                </div>
            </div>
        </aside>
<script src="./js/menu.js"></script>
