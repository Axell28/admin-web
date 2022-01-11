<?php

class Funciones
{

    public static function getFechaActual()
    {
        return utf8_encode(strftime("%A, %d de %B del %Y", strtotime(date("d-m-Y"))));
    }

    public static function formatFecha($datsql)
    {
        return date('d-m-Y', strtotime($datsql));
    }

    public static function formatURL($str)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($str, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }

    public static function generarPass($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    public static function limpString($str)
    {
        $str = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $str);
        $str = trim($str);
        $str = stripslashes($str);
        $str = str_ireplace("--", "", $str);
        $str = str_ireplace("^", "", $str);
        $str = str_ireplace("[", "", $str);
        $str = str_ireplace("]", "", $str);
        $str = str_ireplace("==", "", $str);
        $str = str_ireplace("<?php", "", $str);
        $str = str_ireplace("?>", "", $str);
        return $str;
    }
}
