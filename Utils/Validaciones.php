<?php
function isText($var){
    return preg_match('/^[a-zA-Z áéíóúAÁÉÍÓÚ]+$/',$var);
}

//El dui debe tener este formato ########-#
function isDUI($var){
    return preg_match('/^[0-9]{8}-[0-9]$/', $var);
}
//47896520-5

//El dui telefono tener este formato ####-###
function isPhone($var){
    return preg_match('/^[267][0-9]{3}-[0-9]{4}$/', $var);
}
//2258-7412

function isMail($var){
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}


function isTarjeta($var) {
    return preg_match('/^[0-9]{16}$/', $var);
}

//el cvv solo deben de ser 3 numeros del 0 al 9
function isCvv($var){
    return preg_match('/^[0-9]{3}$/', $var);
}

?>