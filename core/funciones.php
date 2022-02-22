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

    public static function translate(string $str, string $convert = 'en')
    {
        $gt = new GoogleTranslate();
        $str = $gt->translate(LANG_DEFAULT, $convert, $str);
        return $str;
    }

    public static function translateHTML(string $html, string $convert = 'en')
    {
        $gt = new GoogleTranslate();
        $dom = new DOMDocument();
        $dom->loadHTML("<meta http-equiv='Content-Type' content='charset=utf-8' /> " . $html);
        $nodos = $dom->getElementsByTagName('div');
        for ($i = 0; $i < $nodos->length; $i++) {
            $aux = $nodos->item($i)->textContent;
            $nodos->item($i)->textContent = $gt->translate(LANG_DEFAULT, $convert, $aux);
        }
        return $dom->saveHTML();
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
