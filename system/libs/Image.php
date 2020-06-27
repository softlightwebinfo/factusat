<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author Pabhoz
 */
class Image
{

    public static function upload($carpeta, $nombreInput, $nombreImg = false, $sizeLimit = false, $checkFormat = false)
    {

        $target_dir = $carpeta; //carpeta del servidor donde guardamos las imagenes
        $extension = explode(".", basename($_FILES[$nombreInput]["name"]));
        $extension = $extension[count($extension) - 1];
        $nameFile = ($nombreImg) ? $nombreImg : md5(time()) . "." . $extension;
        $target_file = ($nombreImg) ? $target_dir . $nombreImg . "." . $extension : $target_dir . md5(time()) . "." . $extension; //ubicamos el fantasma
        //echo 'target file:'.$target_file;
        $uploadOk = 1; //estado de la subida
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION); //extraemos el tipo de fantasma
// pillamos si el fantasma es de verdad una imagen

        $check = getimagesize($_FILES[$nombreInput]["tmp_name"]); //verificamos que sea imagen
        if ($check == false) {
            $uploadOk = 0;
        }
// Check file size
        if ($sizeLimit > 0) {
            if ($_FILES[$nombreInput]["size"] > $sizeLimit) {
                $uploadOk = 0;
            }
        }
// Allow certain file formats
        if ($checkFormat) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
//si el fantasma no fue imagen o si el peso es excesivo o si no cumple con el formato, entonces no lo atrape, pero si cumple todos los filtros, atrapelo
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777);
            }
            if (move_uploaded_file($_FILES[$nombreInput]["tmp_name"], $target_file)) {//si se completa la atrapada del fantasma (ubicandolo en la direcciòn deseada)
                return $nameFile;
            } else {
                return false;
            }
        }

    }

    public static function uploadFile($ruta, $input = "file")
    {
        $allowedTypes = array('image/png','image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'application/pdf', 'application/doc');
        if (in_array($_FILES[$input]['type'], $allowedTypes)) {
            $ext = pathinfo($_FILES[$input]['name'], PATHINFO_EXTENSION);
            $name = md5(microtime()) . "." . $ext;
            if (!is_dir($ruta)) {
                mkdir($ruta, 0777);
            }
            if (move_uploaded_file($_FILES[$input]['tmp_name'], $ruta . $name)) {
                return $name;
            } else {
                throw new Exception("No se ha podido subir el archivo", 201);
            }
        } else {
            throw new Exception("EL formato no es valido", 200);
        }
    }

    public static function uploadArray($carpeta, $array, $nombreImg = false, $sizeLimit = false, $checkFormat = false)
    {

        $target_dir = $carpeta; //carpeta del servidor donde guardamos las imagenes
        $extension = explode(".", basename($array["name"]));
        $extension = $extension[count($extension) - 1];
        $name = md5((microtime())) . "." . $extension;
        $target_file = ($nombreImg) ? $target_dir . $nombreImg . "." . $extension : $target_dir . $name; //ubicamos el fantasma
        //echo 'target file:'.$target_file;
        $uploadOk = 1; //estado de la subida
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION); //extraemos el tipo de fantasma
// pillamos si el fantasma es de verdad una imagen

        $check = getimagesize($array["tmp_name"]); //verificamos que sea imagen
        if ($check == false) {
            $uploadOk = 0;
        }
// Check file size
        if ($sizeLimit > 0) {
            if ($array["size"] > $sizeLimit) {
                $uploadOk = 0;
            }
        }
// Allow certain file formats
        if ($checkFormat) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
//si el fantasma no fue imagen o si el peso es excesivo o si no cumple con el formato, entonces no lo atrape, pero si cumple todos los filtros, atrapelo
            if (move_uploaded_file($array["tmp_name"], $target_file)) {//si se completa la atrapada del fantasma (ubicandolo en la direcciòn deseada)
                return $name;
            } else {
                return false;
            }
        }

    }

}
