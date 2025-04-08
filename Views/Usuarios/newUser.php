<!--Form de regiatro de nuevos usuarios-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/ProyectoCatedra_LIS/Views/css/Cupones.css">
</head>
<body background="/ProyectoCatedra_LIS/Views/css/img/country-quilt.png">
    <div>
        <nav style="background-color:#d6e6c3" class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 m-3">
                                <img src="/ProyectoCatedra_LIS/Views/css/img/ticket.jpg" alt="Logo" width="100px" height="auto"
                                    class="d-inline-block align-text-top rounded-circle">
                            </div>
                            <div class="col-sm-4">
                                <br>
                                <h1 class="text-shado" style="font-size: 40px;color: #fff;font-family: 'Times New Roman', Times, serif;">
                                    La Cuponera
                                </h1>
                            </div>
                        </div>
                    </div>
                </a>
            
            </div>
            
            </nav>
        </div>
    
        <hr>
        <div style="text-align: center;">
        <h1 class="text-shadow" style="background-color: #fff; display: inline-block; padding: 5px 10px; border-radius: 5px; 
            color: #000; font-family: 'Times New Roman', Times, serif;">Registro de usuarios</h1>
    </div>
    <div style="text-align: center;">
        <img style="width: 200px; height: auto; border: 3px solid #d6e6c3" class="rounded-circle"
            src="/ProyectoCatedra_LIS/Views/css/img/ticket.jpg" alt="cuponera">
    </div>


    <div class="container mt-4">
    <?php
            //recorriendo la vista de errores

            if(isset($errores)){
                echo"<div class='alert alert-danger'>";
                echo"<ul>";
                foreach($errores as $error){
                    //<li> es para que se muestren los errores con viñetas
                    echo"<li>$error</li>";
                }
                echo"</ul>";
                 echo"</div>";
            }
            ?>
        <div class="row">
            <div class="col-md-6">
                <form role="form" action="<?= PATH.'/Usuarios/registerUser'?>" method="POST"> <!--Dirigiendo al metodo registerUser de UsuariosController-->
                <input type="hidden" name="op" value="insertar"/>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"value="<?=empty($usuario['nombre'])?'':$usuario['nombre']?>" placeholder="Ingrese sus nombres">
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" id="apellido"value="<?=empty($usuario['apellido'])?'':$usuario['apellido']?>" placeholder="Ingresa sus apellidos">
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono"value="<?=empty($usuario['telefono'])?'':$usuario['telefono']?>" placeholder="Ingresa su numero de telefono">
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electronico:</label>
                        <input type="text" class="form-control" id="correo" name="correo"value="<?=empty($usuario['correo'])?'':$usuario['correo']?>" placeholder="Ingresa su correo electronico">
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"value="<?=empty($usuario['direccion'])?'':$usuario['direccion']?>" placeholder="Ingresa su direccion">
                    </div>

                    <div class="mb-3">
                        <label for="DUI" class="form-label">DUI:</label>
                        <input type="text" class="form-control" id="DUI" name="DUI"value="<?=empty($usuario['DUI'])?'':$usuario['DUI']?>" placeholder="Ingrese su numero de DUI">
                    </div>

                    <div class="mb-3">
                        <label for="contra" class="form-label">Contraseña:</label>
                        <input type="text" class="form-control" id="contra" name="contra" placeholder="Ingrese su contraseña">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    <a class="btn btn-danger" href="<?=PATH.'/Usuarios/login'?>">Cancelar</a>

                </form>
        </div>
        </div>
        </div>

     

            </div>

        </div>

    </div>
    <br><br><br> 
</body>
</html>