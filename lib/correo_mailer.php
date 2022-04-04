<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once './PHPMailer/PHPMailer.php';

// no toca para nada
$objmail = new PHPMailer();
$objmail->CharSet = 'UTF-8';
$objmail->IsHTML(true);
$objmail->isSMTP();
$objmail->SMTPDebug  = false;
$objmail->SMTPSecure = '';
$objmail->Host = 'correo.cubicol.com.pe';
$objmail->SMTPAuth = false;
$objmail->Port = 25;

// modificar
$objmail->From = 'humboldt@cubicol.com.pe';
$objmail->FromName = 'PAG. WEB';
$objmail->AddAddress('correo_cliente@com', 'NOMBRE DEL CLIENTE');
$objmail->AddCC('', 'NOMBRE DEL CLIENTE');
$objmail->Subject = 'ASUNTO RELACINADO';
$objmail->Body = '
            <h4><b>INFORMACIÓN</b></h4>
            <p><b>Nombre : </b>' . $_POST['nombre'] . '</p>
            <p><b>Correo : </b>' . $_POST['correo'] . '</p>
            <p><b>Consulta : </b>' . $_POST['consulta'] . '</p>';
if ($objmail->Send()) {
    echo "SE ENVIO LA CONSULTA CORRECTAMENTE";
} else {
    echo 'OCURRIÓ UN ERROR, NO SE PUDO PROCESAR EL ENVÍO';
}
