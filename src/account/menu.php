<style>

    #email:target, #password:target {
        color: #ff640a;
    }

</style>

<nav class="nav">
                <ul class="nav__list">
                    <li class="nav__list-item"><h3>Menu</h3></li>
                    <a href="../index.php"><li class="nav__list-item">Inicio</li></a>
                    <a href="../administrar-usuarios.php#menu-user"><li class="nav__list-item">Volver atras</li></a>
                    <li class="nav__list-item"><h3>Informacion General</h3></li>
                    <li class="nav__list-item">Bienes</li>
                    <li class="nav__list-item">Bienes desincorporados</li>
                    <li class="nav__list-item">Solicitudes</li>
                    <li class="nav__list-item"><h3>Cuenta</h3></li>
                    <a href="email.php?id=<?php echo $id ?>#email"><li  id="email" class="nav__list-item">Email</li></a>
                    <a href="password.php?id=<?php echo $id ?>#password"><li id="password" class="nav__list-item">Contraseña</li></a>
                </ul>
            </nav>  