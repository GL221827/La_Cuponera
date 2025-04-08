<?php

require_once 'Model.php';

class UsuariosModel extends Model {

 
    //Devuelve toda la informacion del usuario, este metodo servira para que el admin vea todos los usuarios registrados
    public function getUser($id=''){
        if($id== ''){
            $query = "SELECT * FROM usuario";
            return $this->get_query($query);
        }
        else{
            $query = "SELECT * FROM usuario WHERE id_Usuario = :id_usuario";
            return $this->get_query($query, [':id_usuario' => $id]);
        }
    }

    //Inserta nuevos usuarios
    public function insertUser($usuario = array()){
        $query = "INSERT INTO usuario (nombre, apellido, telefono, correo, direccion, DUI, contra, id_tipo_usuario, codigo_verificacion, verificado) 
        VALUES (:nombre, :apellido, :telefono, :correo, :direccion, :DUI, :contra, :id_tipo_usuario, :codigo_verificacion, :verificado)"; //CORRECCION:Puse lo del SHA2-512 en el método controlador antes de llamar a insertUser
        return $this->set_query($query, $usuario);
    }
    


    public function deleteUser($id = ''){
        $query = 'DELETE FROM usuario WHERE id_Usuario = :id_usuario';
        return $this->set_query($query, [':id_usuario' => $id]);
    }



    public function updateUser($usuario = array()){
        $query = 'UPDATE usuario SET nombre = :nombre, apellido= :apellido, telefono= :telefono, correo = :correo, 
        direccion= :direccion, contra = SHA2(:contra,512), DUI= :dui, id_tipo_usuario= :tipo_usuario
                  WHERE id_Usuario = :id_usuario';
        return $this->set_query($query, $usuario);
    }

    //metodo para validar que las credenciales enten en la BD
    public function validateLogin($correo, $contra){
        // Preparamos la consulta SQL para verificar el correo y la contraseña
        $query = "SELECT id_tipo_usuario FROM usuario WHERE correo = :correo AND contra = SHA2(:contra, 512)";
        
        // Llamamos a la función get_query pasando las variables
        return $this->get_query($query, ['correo' => $correo, 'contra' => $contra]);
    }


    //Metodo para hacer la verificacion de la cuenta del usuario registrado
    public function verificarToken($token) {
        $query = "SELECT * FROM usuario WHERE codigo_verificacion = :token AND verificado = 0";
        return $this->get_query($query, [':token' => $token]);
    }

    //para cambiar el campo verificado de 0 a 1 cuando el user ya se haya verificado
    public function Verificado($idUsuario) {
        $query = "UPDATE usuario SET verificado = 1, codigo_verificacion = NULL WHERE id_Usuario = :id";
        return $this->set_query($query, [':id' => $idUsuario]);
    }
    
    
}
