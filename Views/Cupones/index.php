<!--Form principal, aqui se muestran la lista de ofertas/cupones-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuponera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/ProyectoCatedra_LIS/Views/css/Cupones.css">
</head>

<body background="/ProyectoCatedra_LIS/Views/css/img/country-quilt.png">
  <!-- Navbar -->
  <div>
    <nav style="background-color:#d6e6c3" class="navbar">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">
          <div class="container">
            <div class="row">
              <div class="col-sm-4 m-3">
                <img src="/ProyectoCatedra_LIS/Views/css/img/ticket.jpg" alt="Logo" width="100px" height="auto"
                  class="d-inline-block align-text-top rounded-circle">
              </div>
              <div class="col-sm-4">
                <br>
                <h1 class="text-shado" style="font-size: 40px;color: #fff;font-family: 'Times New Roman', Times, serif;">La Cuponera</h1>             
               </div>
            </div>
          </div>
        </a>

       
        <div>
          <a href="/ProyectoCatedra_LIS/Usuarios/logout" class="btn btn-danger me-4">Cerrar sesión</a>
        </div>
      </div>
    </nav>
  </div>

  <hr>

  <div style="text-align: center;">
    <h1 class="text-shadow" style="background-color: #fff; display: inline-block; padding: 5px 10px; border-radius: 5px; 
      color: #000; font-family: 'Times New Roman', Times, serif;">
      Cupones Disponibles
    </h1>
  </div>

  <br>

  <div style="text-align: center;">
    <img style="width: 200px; height: auto; border: 3px solid #d6e6c3" class="rounded-circle"
      src="/ProyectoCatedra_LIS/Views/css/img/ticket.jpg" alt="cuponera">
  </div>

  <br>
   
   

  <div class="container">
    <table class="table table-striped table-bordered border-success">
      <thead class="table-dark">
        <tr>
          <th>Titulo:</th>
          <th>Precio Regular:</th>
          <th>Precio oferta:</th>
          <th>Fecha inicio:</th>
          <th>Fecha fin:</th>
          <th>Fecha limite:</th>
          <th>cantidad disponible:</th>
          <th>Descripcion:</th>
          <th>detalles:</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($cupones as $cupon): ?>
        <tr>
          <td><?= $cupon['titulo'] ?></td>
          <td>$<?= $cupon['precio_regular'] ?></td>
          <td>$<?= $cupon['precio_oferta'] ?></td>
          <td><?= $cupon['fecha_inicio'] ?></td>
          <td><?= $cupon['fecha_fin'] ?></td>
          <td><?= $cupon['fecha_limite_uso'] ?></td>
          <td><?= $cupon['cantidad_limite'] ?></td>
          <td><?= $cupon['descripcion'] ?></td>
          <td><?= $cupon['detalles'] ?></td>
          <td><a href="<?= PATH . '/Cupones/comprar/' . $cupon['id_Ofertas'] ?>" class="btn btn-info">Canjear</a></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <br><br>
  </div>

  <br>
  
</body>
</html>
