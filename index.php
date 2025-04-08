<?php
//front controller aqui se ponen todas las peticiones
include_once 'Controllers/IndexController.php';
include_once 'Controllers/UsuariosController.php';
include_once 'Controllers/CuponesController.php';

//Archivos de phpMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

const PATH= '/ProyectoCatedra_LIS';
//iniciando sesion de php
session_start();

$url= $_SERVER['REQUEST_URI'];
$slices= explode('/', $url);
$controller=empty($slices[2])?"IndexController":$slices[2]."Controller";
$method=empty($slices[3])?"index":$slices[3];
$param=empty($slices[4])?[]:array_slice($slices,4);
$cont= new $controller;
$cont->$method($param);

//echo $controller;
//echo $method;
//print_r($param);