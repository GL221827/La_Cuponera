<?php
require_once 'Controller.php';
require_once 'Models/UsuariosModel.php';
require_once 'Utils/Validaciones.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class UsuariosController extends Controller{
    private $model;


    function __construct(){
        
        $this->model= new UsuariosModel();
    }

   
    public function createUser(){
        $this->render('newUser.php');
        //echo "<h1>Aqui se mostrara el fomulario para crear user</h1>";
    }


    //Metodo para que el usuario verifique su cuenta, esto se muestra al instante que el user se registre en el form
    //debe mandarlo a su correo para que valide su cuenta
    public function verifyAccount(){
        $this->render('verifyUser.php');
    }
    

    //Metodo dirige el formulario de login
    public function login(){
        $this->render("loginUser.php");
    }


    

    //Metodo para insertar usuarios en la BD y registrarlos
    public function registerUser() {
        $viewBag=array();// almacena el mensaje de error si el registro falla.
        
        if (isset($_POST)) {

            $errores=array();
    
            $usuario['nombre']= $_POST['nombre'];
            $usuario['apellido']= $_POST['apellido'];
            $usuario['telefono']= $_POST['telefono'];
            $usuario['correo']= $_POST['correo'];
            $usuario['direccion']= $_POST['direccion'];
            $usuario['DUI']= $_POST['DUI'];
            $usuario['contra']= hash('sha512', $_POST['contra']); // se hashea aqui la contraseña para que cuando la ingrese se encripte en la base
            $usuario['id_tipo_usuario'] = 2; //Por default todos los usuarios que se registren por el momento seran tipo 1 o sea "Clientes" con acceso a la interfaz publica
    
             // Token y verificado
            $usuario['codigo_verificacion'] = bin2hex(random_bytes(32)); // genera el token aleatorio
            $usuario['verificado'] = 0; //Verificado es 0 porque no esta verificada la cuenta del user, al ser verificada el valor sera 1


            //Validaciones de los campos
            if(empty($usuario['nombre'])){
                array_push($errores, "Debe de ingresar su nombre");
            }
            if(empty($usuario['apellido'])){
                array_push($errores, "Debe de ingresar su apellido");
            }
    
            if(!isPhone($usuario['telefono'])){
                array_push($errores, "El telefono ingresado no tinene un formato valido");
            }

            if(!isMail($usuario['correo'])){
                array_push($errores, "Por favor ingrese un correo valido");
            }
            if(empty($usuario['direccion'])){
                array_push($errores, "Debe de ingresar su direccion");
            }
            if(!isDUI($usuario['DUI'])){
                array_push($errores, "El numero de DUI ingresado no tinene un formato valido");
            }
           
           // Si no hay errores, se intenta insertar el usuario
           if (count($errores) == 0) {
            $insertado = $this->model->insertUser($usuario);
        
            if ($insertado != 0) {
                $this->sendEmail($usuario['correo'], $usuario['nombre'], $usuario['codigo_verificacion']);
                $this->render('verifyUser.php');
            } else {
                $errores[] = "Ya existe un usuario con el correo ingresado.";
                $viewBag['errores'] = $errores;
                $viewBag['usuario'] = $usuario;
                $this->render('newUser.php', $viewBag);
            }
        } else {
            //Para mostrar los errores en el form de registro
            $viewBag['errores'] = $errores;
            $viewBag['usuario'] = $usuario;
            $this->render('newUser.php', $viewBag);
        }
    
    }
}

//Funcion que redirije a la pagina de bienvenida luego de verificar la cuenta registrada
public function accountCreated($param) {
    if (!empty($param[0])) {
        $token = $param[0];
        $usuario = $this->model->verificarToken($token);

        if (!empty($usuario)) {
            $idUsuario = $usuario[0]['id_Usuario'];
            $this->model->Verificado($idUsuario);
            $this->render('welcome.php');
            
        } else {
            $viewBag['error'] = 'Token inválido o cuenta ya verificada.';
            return $this->render('verifyUser.php', $viewBag);
        }
    }
}



//Metodo para que envie el correo usando la biblioteca PHPMailer
     public function sendEmail($correo, $nombre, $token){
        $mail = new PHPMailer(true);
       

                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'lacuponera.info.usuarios@gmail.com'; //correo creado solo para la cuponera
                    $mail->Password   = 'bnps ywoa mpnc pfcr'; //Contra creada con verificaion de dos pasos (esta no deberia mostrarse pero como es del correo de la empresa la puse)
                    $mail->SMTPSecure = 'tls'; 
                    $mail->Port       = 587;
                    $mail->setFrom('lacuponera.info.usuarios@gmail.com', 'LaCuponera'); //remitente y nombre de usuario
                    $mail->addAddress($correo, $nombre); //A quien ira dirigido el correo

                $mail->isHTML(true);
                $mail->Subject = 'Verifica tu cuenta'; //subject del correo

                // Link de verificación
               $linkVerificacion = $linkVerificacion = 'http://' . $_SERVER['HTTP_HOST'] . PATH . '/Usuarios/accountCreated/' . $token; //$_SERVER['HTTP_HOST']  obtiene tu dominio local 



                $mail->Body    = 'Hola '. $nombre .' para activar tu cuenta accede a <a href="'.$linkVerificacion.'"><b>AQUI</b>'; //concatena el nombre para que se vea mas bonito
                $mail->AltBody = 'Hola '. $nombre .' para activar tu cuenta accede a <a href="'.$linkVerificacion.'"><b>AQUI</b>';

                $mail->send();
            } catch (Exception $e) {
                $viewBag['error'] = "No se pudo enviar el correo de verificación. Error: {$mail->ErrorInfo}";
                return $this->render("newUser.php", $viewBag);
            }

            }
        


    //Metodo para verificar que las credenciales esten en la BD
    public function check_user(){

        //verificar que los usuarios no verificado no enten a cupones

        
        $viewBag=array();
        $correo=$_POST['correo'];
        $contra=$_POST['contra'];
        $result=$this->model->validateLogin($correo,$contra);

        //si los espacios estan vacios se redirecciona a login de nuevo
        if(empty($result)){
            $viewBag['error']='Correo o contraseña incorrecta';
            $this->render('loginUser.php',$viewBag);
        }
        else{
            //antes de redireccionar hay que iniciar las variables de sesion para se 
            // almacene la info del user antes de entrar a la pgina
            $_SESSION['correo']=$correo;
            $_SESSION['id_tipo_usuario']=$result[0]['id_tipo_usuario'];
            header('location:'.PATH.'/Cupones');

    }
}

    //Metodo para cerrar sesion
    public function logout(){
        unset($_SESSION['correo']);
        unset($_SESSION['id_tipo_usuario']);
        $_SESSION=array();
        $this->render('loginUser.php');


    }
    

}