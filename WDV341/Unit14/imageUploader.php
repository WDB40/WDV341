<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

        $allowed = array(
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png"
        );

        $fileName = $_FILES["photo"]["name"];
        $fileType = $_FILES["photo"]["type"];
        $fileSize = $_FILES["photo"]["size"];

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if(!array_key_exists($extension, $allowed)){
            die("Error: Please select a valid file format.");
        }

        $maxSize = 5 * 1024 * 1024;
        if($fileSize > $maxSize){
            die("Error: FIle size is larger than the allowed limit.");
        }

        if(in_array($fileType, $allowed)){
            if(file_exists("upload/" . $fileName)){
                echo $fileName . " already exists.";
            } else {
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $fileName );
                echo "Your file was uploaded successfully.";
            }
        } else {
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}