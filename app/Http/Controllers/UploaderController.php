<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploaderController extends Controller
{
    public function uploader($file, $target_dir) {
        $file_extension = array_reverse(explode(".", basename($file["name"])))[0];
        $file_name = "avatar_" . microtime() . "." . $file_extension;
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        list($width, $height) = getimagesize($file["tmp_name"]);
        if($width == 0 || $height == 0) {
            echo json_encode(array(
                "message" => "File is not an image.",
                "status"  => "error"
            ));
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo json_encode(array(
                "message" => "File already exists.",
                "status"  => "error"
            ));
            die();
        }

        // Check file size
        if ($file["size"] > 500000) {
            echo json_encode(array(
                "message" => "File is too large.",
                "status" => "error"
            ));
            die();
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo json_encode(array(
                "message" => "Only JPG, JPEG, PNG & GIF files are allowed.",
                "status" => "error"
            ));
            die();
        }

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
          return $file_name;
        } else {
            echo json_encode(array(
                "message" => "An unknown error occured while uploading the file.",
                "status" => "error"
            ));
            die();
        }
    }
}
