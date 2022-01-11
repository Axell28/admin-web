<?php

class ArchivosModel
{

    public function guardarArchivo($file, string $ruta)
    {
        if ($file['type'] == 'image/jpg' || $file['type'] == 'image/png' || $file['type'] == 'image/jpeg') {
            $vals = explode('/', $ruta);
            $path = DIROOT . '/assets' . $ruta;
            if ($vals[2] == 'banner') {
                return move_uploaded_file($file['tmp_name'], $path);
            } else {
                return $this->reducirImagen($file, $path);
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
                    "icon" => $this->obtenerIcono(pathinfo($file, PATHINFO_EXTENSION))
                );
            endif;
        endwhile;
        $this->ordenarFiles($list, 'date', SORT_DESC);
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

    private function ordenarFiles(&$arrIni, $col, $order)
    {
        $arrAux = array();
        foreach ($arrIni as $key => $row) {
            $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
            $arrAux[$key] = $arrAux[$key];
        }
        array_multisort($arrAux, $order, $arrIni);
    }

    private function obtenerIcono($tipo)
    {
        $icono = 'far fa-file-alt';
        switch ($tipo) {
            case 'pdf':
                $icono = 'far fa-file-pdf';
                break;
            case 'mp4':
            case 'avi':
                $icono = 'fas fa-film';
                break;
            case 'zip':
            case 'rar':
                $icono = 'far fa-file-archive';
                break;
            case 'docx':
                $icono = 'far fa-file-word';
                break;
            case 'mp3':
                $icono = 'fas fa-music';
                break;
        }
        return $icono;
    }

    private function reducirImagen($file, string $ruta)
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

            $nuevo = imagecreatetruecolor($ancho_final, $alto_final);
            imagecopyresampled($nuevo, $imagenAux, 0, 0, 0, 0, $ancho_final, $alto_final, $widht, $height);

            if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg') {
                return imagejpeg($nuevo, $ruta);
            } else if ($file['type'] == 'image/png') {
                return imagepng($nuevo, $ruta);
            } else {
                die("El tipo de imagen no esta soportado");
            }
        } else {
            return move_uploaded_file($file['tmp_name'], $ruta);
        }
    }
}
