<!--Form de login para usuarios ya registrados-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuarios</title>
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

                <div>
          <a href="/ProyectoCatedra_LIS/Usuarios/createUser" class="btn btn-success me-4">Registrarse</a>
        </div>
            </div>
            
        </nav>
    </div>

    <hr>

    <div style="text-align: center;">
        <h1 class="text-shadow" style="background-color: #fff; display: inline-block; padding: 5px 10px; border-radius: 5px; 
            color: #000; font-family: 'Times New Roman', Times, serif;">
            Ingrese a su cuenta
        </h1>
    </div>

    <br>

    <div style="text-align: center;">
        <img style="width: 200px; height: auto; border: 3px solid #d6e6c3" class="rounded-circle"
            src="/ProyectoCatedra_LIS/Views/css/img/ticket.jpg" alt="cuponera">
    </div>

    

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <form role="form" action="<?= PATH . '/Usuarios/check_user' ?>" method="POST">
                    <input type="hidden" name="op" value="insertar"/>
                    
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu correo electrónico">
                    </div>

                    <div class="mb-3">
                        <label for="contra" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contra" name="contra" placeholder="Ingresa tu contraseña">
                    </div>

                    <button type="submit" class="btn btn-primary">Ingresar</button>
                    
                   
                </form>
                <br>

                <!--Corriendo el error si las credenciales no son encontradas o estan erroneas-->
                <?php
               //la variable $error fue la que definimos en el $viewBag en UsuariosController
               if(isset($error)){
        
                echo "<div class='alert alert-danger'><p>$error</p></div>";

                }
               ?>
                <br>
                <br>
               <br> 
            </div>
        </div>
       
    </div>
    
    
</body>
</html>
