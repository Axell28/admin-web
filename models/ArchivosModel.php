<?php

class ArchivosModel
{

    public function guardarArchivo($file, string $folder, string $ruta)
    {
        if ($file['type'] == 'image/jpg' || $file['type'] == 'image/png' || $file['type'] == 'image/jpeg') {
            $path = DIROOT . '/assets' . $ruta;
            if ($folder == 'banner') {
                return move_uploaded_file($file['tmp_name'], $path);
            } else {
                return $this->procesarImagen($file, $path);
            }
        } else {
            $path = DIROOT . '/assets' . $ruta;
            return move_uploaded_file($file['tmp_name'], $path);
        }
    }

    public function eliminarArchivo(string $ruta)
    {
        $path = DIROOT . $ruta;
        if (file_exists($path)) {
            if (unlink($path)) {
                return true;
            }
        }
        return false;
    }


    public function listarArchivos(string $ruta, string $filter = null)
    {
        $dir = dir(DIROOT . '/assets' . $ruta);
        $list = array();
        while (($file = $dir->read()) != false) :
            if (strlen($file) > 2) :
                $list[] = array(
                    "name" => utf8_encode($file),
                    "tipo" => pathinfo($file, PATHINFO_EXTENSION),
                    "size" => $this->obtenerSizeFile(filesize($dir->path . $file)),
                    "date" => date("d-m-Y H:i", filemtime($dir->path . $file)),
                    "time" => filemtime($dir->path . $file),
                    "path" => '/assets'  . $ruta . utf8_encode($file),
                    "icon" => $this->obtenerIcono(pathinfo($file, PATHINFO_EXTENSION)),
                    "remove" => $this->isRemove(utf8_encode($file))
                );
            endif;
        endwhile;
        // ordernar por fecha de subida
        usort($list, function ($a, $b) {
            return $a['time'] < $b['time'];
        });
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

    private function obtenerIcono($tipoFile)
    {
        $icono = 'far fa-file';
        switch ($tipoFile) {
            case 'pdf':
                $icono = 'far fa-file-pdf';
                break;
            case 'zip':
            case 'rar':
                $icono = 'far fa-file-archive';
                break;
            case 'mp4':
                $icono = 'fas fa-film';
                break;
            case 'docx':
                $icono = 'far fa-file-word';
                break;
            case 'mp3':
                $icono = 'fas fa-volume-down';
                break;
        }
        return $icono;
    }

    private function procesarImagen($file, string $ruta)
    {
        $max_width = 1000;
        $max_height = 900;
        list($widht, $height) = getimagesize($file['tmp_name']);

        if ($widht >= $max_width) {
            if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg') {
                $imagenAux = imagecreatefromjpeg($file['tmp_name']);
            } else if ($file['type'] == 'image/png') {
                $imagenAux = imagecreatefrompng($file['tmp_name']);
            }

            $x_ratio = $max_width / $widht;
            $y_ratio = $max_height / $height;

            if (($widht <= $max_width) && ($widht <= $max_height)) {
                $ancho_final = $widht;
                $alto_final = $height;
            } elseif (($x_ratio * $height) < $max_height) {
                $alto_final = ceil($x_ratio * $height);
                $ancho_final = $max_width;
            } else {
                $ancho_final = ceil($y_ratio * $widht);
                $alto_final = $max_width;
            }

            $lienzo = imagecreatetruecolor($ancho_final, $alto_final);
            imagecopyresampled($lienzo, $imagenAux, 0, 0, 0, 0, $ancho_final, $alto_final, $widht, $height);

            if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg') {
                return imagejpeg($lienzo, $ruta);
            } else if ($file['type'] == 'image/png') {
                return imagepng($lienzo, $ruta);
            } else {
                die("El tipo de imagen no esta soportado");
            }
        } else {
            return move_uploaded_file($file['tmp_name'], $ruta);
        }
    }

    private function isRemove($file)
    {
        $lista = array('portada_3.png', 'spiderman-2021.jpg', 'metodologia.jpg', 'fondo-grande-de-prueba.jpg');
        return in_array($file, $lista);
    }
}
