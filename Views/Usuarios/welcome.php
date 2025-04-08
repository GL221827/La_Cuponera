<!--Pagina de bienvenida que se muetsra al abrir el link enviado al correo-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Verificada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/ProyectoCatedra_LIS/Views/css/Cupones.css">
</head>
<body background="/ProyectoCatedra_LIS/Views/css/img/country-quilt.png">
<div style="text-align: center;">
    <img style="width: 200px; height: auto; border: 3px solid #d6e6c3" class="rounded-circle"
      src="/ProyectoCatedra_LIS/Views/css/img/ticket.jpg" alt="cuponera">
  </div>
<br>
    <div class="container mt-4" style="text-align: center;"> 
        <div class="row">
            <h1>Bienvenid@ a La Cuponera!</h1>

        </div>

        <div class="row">
            <div class="col-md-12">
                <form role="form" action="<?=PATH.'/Usuarios/verifyAccount'?>" method="POST">
                <h2>Tu cuenta ha sido validada con exito</h2>
                <br>
                <h3>Inicia sesion con tus credenciales para ver las ofertas</h3>
               <br><br>
                </form>
                <a class="btn btn-info" href="<?=PATH.'/Usuarios/login'?>">Iniciar sesion</a> 
            </div>

        </div>
</div>

    </div>
</body>
</html>