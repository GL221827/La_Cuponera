<?php
require_once 'Model.php';

 class CuponesModel extends Model{
     //Devuelve toda la informacion del usuario, este metodo servira para que el admin vea todos los usuarios registrados
     public function getCupones($id=''){
        if($id== ''){
            $query = "SELECT * FROM ofertas";
            return $this->get_query($query);
        }
        else{
            $query = "SELECT * FROM ofertas WHERE id_Ofertas = :id_ofertas";
            return $this->get_query($query, [':id_ofertas' => $id]);
        }
    }

    public function actualizarCantidadCupones($cupon = array()){
        $query = "UPDATE ofertas 
                  SET cantidad_limite = cantidad_limite - :cantidad_limite 
                  WHERE id_Ofertas = :id_ofertas AND cantidad_limite >= :cantidad_limite";
    
        return $this->set_query($query, $cupon);
    }
}