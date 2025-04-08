<!--Form de pago, aqui se el user pone la informacion de su tarjeta y abre el modal para confirmar la transaccion-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Pagos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="/ProyectoCatedra_LIS/Views/css/Formulario_Pagos.css">

</head>

<body background="/ProyectoCatedra_LIS/Views/css/img/country-quilt.png">

    <?php 
        $cupon = $ofertas[0];
    ?>

    <nav style="background-color:#d6e6c3 ;" class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="/ProyectoCatedra_LIS/Views/css/img/metodo-de-pago.png" alt="Logo" width="100px" height="auto"
                            class="d-inline-block align-text-top">
                    </div>
                    <div class="col-sm-4">

                        <div class="col-sm-4">
                            <br>
                            <h1 class="text-sombra"
                                style="font-size: 40px;color: #fff;font-family: 'Times New Roman', Times, serif;">Pago con Tarjeta</h1>
                        </div>

                    </div>

                </div>

            </a>
        </div>
    </nav>

    <hr>
    <br>
    <div style="border: 1px solid #227a07; padding: 20px; margin: 0 70px; border-radius: 10px;">
        <div class="container">
        <?php 
                    if(isset($errores)){
                        echo "<div class='alert alert-danger'>";
                        echo "<ul>";
                        foreach($errores as $error){
                            echo "<li>$error</li>";
                        }
                        echo "</ul>";
                        echo "</div>";
                    }
                ?>
        </div>
        <div style="text-align: center;">
            <h1 class="text" style="background-color: #fff; display: inline-block; padding: 5px 10px; border-radius: 5px; 
                color: #000; font-family: 'Times New Roman', Times, serif;">
                Datos de la Tarjeta
            </h1>
        </div>

        <div style="border: 1px solid #000; padding: 20px; margin: 0 50px; border-radius: 10px; text-align: left;">
            <span
                style="font-size: 17px; background-color: #fff; display: inline-block; padding: 5px 10px; border-radius: 5px; font-family: 'Times New Roman', Times, serif;">
                Solo se aceptan las siguientes tarjetas de crédito o débito
            </span>
            <br><br>

            <div class="row justify-content-center align-items-start">
                <div class="col-sm-5 text-center">
                    <img src="https://productos.tribuexcel.com/wp-content/uploads/2020/12/visa-and-mastercard-logos-logo-visa-png-logo-visa-mastercard-png-visa-logo-white-png-awesome-logos-705x210-1.png"
                        class="img-thumbnail" alt="visa" style="max-width: 360px;">

                    <img src="/ProyectoCatedra_LIS/Views/css/img/tarjeta.png" class="img-thumbnail" alt="Tarjeta" style="max-width: 360px;">


                </div>
                <div class="col-sm-5">
                <form method="POST" action="/ProyectoCatedra_LIS/Cupones/transaccion/<?=$cupon['id_Ofertas']?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b
                                    style="font-family: 'Times New Roman', Times, serif;">No. Tarjeta</b></label>
                            <input type="number" name="tarjeta" class="form-control" id="tarjeta" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b
                                    style="font-family: 'Times New Roman', Times, serif;">Vencimiento</b></label>
                            <input type="date" name="fecha" class="form-control" id="fecha" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"><b
                                    style="font-family: 'Times New Roman', Times, serif;">CVV</b></label>
                            <input type="number" class="form-control" id="cvv" name="cvv">
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label"><b
                                    style="font-family: 'Times New Roman', Times, serif;">Cantidad</b></label>
                                    <input type="number" id="cantidad" name="cantidad" min="1" max="<?= $cupon['cantidad_limite']?>" class="form-control" required>
                        </div>
                        <br>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <b>Siguiente</b>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pago con Tarjeta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>Confirmar compra</b>

                                        <div class="my-4">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3>Cupón</h3>
                                                    <?=$cupon['titulo']?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3>Precio</h3>
                                                    $<span id="total-pagar"><?=$cupon['precio_oferta']?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"><?=$cupon['fecha_inicio']?></div>
                                                <div class="col-sm-6"><?=$cupon['fecha_fin']?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=PATH.'/Cupones'?>" class="btn btn-info">Regresar</a></td>
                    </form>
                </div>
            </div>

        </div>


        <br>
        <br>

    </div>
    <footer
        style=" border: 1px solid #227a07;background-color: #d6e6c3; margin: 0 70px; border-radius: 0 0 10px 10px; padding: 10px;">
        <h1 style="font-size: 18px;font-family:'Times New Roman', Times, serif ;text-align: right;"><b>Cupón: </b><?= $cupon['titulo']?> | <b>Monto:</b> $<?= $cupon['precio_oferta'] ?></h1>
    </footer>

    <br>

    </div>

    </div>

    <hr>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const cantidadInput = document.getElementById("cantidad");
        const totalPagar = document.getElementById("total-pagar");
        const precio = <?= $cupon['precio_oferta'] ?>;

        function actualizarTotal() {
            const cantidad = parseInt(cantidadInput.value) || 0;
            const total = cantidad * precio;
            totalPagar.textContent = "$" + total.toFixed(2);
        }

        cantidadInput.addEventListener("input", actualizarTotal);
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>