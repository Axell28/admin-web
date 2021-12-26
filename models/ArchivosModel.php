<?php

class ArchivosModel
{

    public function guardarArchivo($ruta, $file)
    {
        $path = DIROOT . '/assets' . $ruta;
        return move_uploaded_file($file, $path);
    }

    public function eliminarArchivo($ruta)
    {
        $path = DIROOT . $ruta;
        if (file_exists($path)) {
            if (unlink($path)) {
                return true;
            }
        }
        return false;
    }

    public function listarArchivos($ruta)
    {
        $dir = dir(DIROOT . '/assets' . $ruta);
        $list = array();
        while (($file = $dir->read()) != false) :
            if (strlen($file) > 3) :
                $list[] = array(
                    "name" => utf8_encode($file),
                    "tipo" => pathinfo($file, PATHINFO_EXTENSION),
                    "size" => $this->obtenerSizeFile(filesize($dir->path . $file)),
                    "date" => date("d-m-Y H:i", filectime($dir->path . $file)),
                    "path" => '/assets'  . $ruta . utf8_encode($file),
                    "icon" => null
                );
            endif;
        endwhile;
        return $list;
    }

    public function totalArchivos($ruta)
    {
        $ruta = DIROOT . '/assets/' . $ruta;
        return count(scandir($ruta)) - 2;
    }

    private function obtenerSizeFile($bytes)
    {
        $label = array('B', 'KB', 'MB', 'GB');
        for ($i = 0; $bytes >= 1024 && $i < (count($label) - 1); $bytes /= 1024, $i++);
        return (round($bytes, 2) . ' ' . $label[$i]);
    }
}
