<?php

include_once("Models/UsuariosModel.php");

//$model = new EmpresaModel();
$modelUser= new UsuariosModel();
/*$empresa = [
    'nombre' => 'Javier',
    'correo' => 'Javier@email.com',  // Se añade el correo
    'telefono' => '7775-7777',
    'contrasena' => 'JaviSV'
];*/

$usuarioNuevo= [
   'id_usuario' => '16',
    'nombre' => 'Monica',
    'apellido' => 'Merino',
    'telefono' => '4596-3256',
    'correo' => 'mmerino@email.com',
    'direccion' => 'Col.Escalon, San Salvador',
    'dui' => '06689475-2',
    'contra' => 'MMonica10',
    'tipo_usuario' => '4'
];

/*$actualizar_empresa = [
    'id_empresa' => '1',
    'nombre' => 'Diana SV',
    'correo' => 'diana@email.com',  // Se añade el correo
    'telefono' => '7777-7777',
    'contrasena' => 'DianaSV'
];*/

//$modelUser->insertUser($usuarioNuevo);
//$modelUser->deleteUser('15');
$modelUser->updateUser($usuarioNuevo);
//$modelUser->update($actualizar_usuario);


// Obtener solo el usuario insertado
var_dump($usuarioNuevo);
//var_dump($modelUser->getUser());

