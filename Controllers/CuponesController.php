<?php

require_once 'Controller.php';
require_once 'Models/CuponesModel.php';
require_once 'Utils/Validaciones.php';

 class CuponesController extends Controller{
    private $model;

    function __construct(){
           //para proteger que solo los usuarios logiados puedan acceder a la lista de cupones
      if(empty($_SESSION['correo'])){
        header('location:'.PATH.'/Usuarios/login');
      }

        $this->model= new CuponesModel();
    }


    //Pagina principal, muestra la lista de cupones disponibles
    public function index(){
        $viewBag=[];
        $viewBag['cupones']=$this->model->getCupones(); //llama a la funcion getCupones definida en CuponesModel
        $this->render("index.php",$viewBag);
      }

      //Metodo para comprar los cupones al precionar el boton canjear
      public function comprar($id){
        $codigo = $id[0];
        $viewBag = [];
        $viewBag['ofertas'] = $this->model->getCupones($codigo);
        $this->render('pagoCupones.php', $viewBag);
    }

    //Metodo para hacer el pago con tarjeta
    public function transaccion($id){
        if (isset($_POST['cantidad'])) {
            $oferta['tarjeta'] = $_POST['tarjeta'];
            $oferta['fecha'] = $_POST['fecha'];
            $oferta['cvv'] = $_POST['cvv'];
            $cantidad = $_POST['cantidad'];
            $codigo = $id[0];
            $viewBag = [];
            $viewBag['cantidad_limite'] = $cantidad;
            $viewBag['id_ofertas'] = $codigo;
            
            $errores = [];
            if(!empty($_POST)){

                
                extract($_POST);
                if(empty(trim($oferta['tarjeta']))){
                    array_push($errores," Por favor se debe llenar el Campo");
                }

            }
            if(!isTarjeta(trim($oferta['tarjeta']))){
                array_push($errores,"Formato no valido");
            }
            if(empty(trim($oferta['fecha']))){
                    
                array_push($errores,"Se debe seleccionar la fecha");

            }
            else if (strtotime($oferta['fecha']) < strtotime(date('Y-m-d'))) {
                echo "Error: La tarjeta está vencida.";
                return;
            };

            if(empty(trim($oferta['cvv']))){
                    
                array_push($errores,"Se debe ingresar el codigo de verificacion de la tarjeta");

            }else if(!isCvv(trim($oferta['cvv']))){
                array_push($errores,"Formato no valido");
            }
            if(empty(trim($cantidad))){
                    
                array_push($errores,"se debe ingresar la cantidad que desea");

            }else if(isText(trim($cantidad))){
                array_push($errores,"formato no valido");
            }
            if(empty($errores)){
                $this->model->actualizarCantidadCupones([
                    ':cantidad_limite' => $cantidad,
                    ':id_ofertas' => $codigo
                ]);
                header('location:'.PATH.'/Cupones/mostrarCompra/'. $viewBag['ofertas']);
            }else{
                
                $viewBag['errores'] = $errores;
                $viewBag['ofertas'] = $codigo;
                
                header('location:'.PATH.'/Cupones/comprar/'. $viewBag['ofertas']);
            }
        } else {
            echo "Error: cantidad no enviada.";
        }
    }

    public function mostrarCompra(){
        $viewBag = [];
        $viewBag['cupones'] = $this->model->getCupones();
        $this->render('CompraRealizada.php', $viewBag);
    }
    
}