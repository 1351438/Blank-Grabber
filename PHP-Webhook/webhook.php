<?php

if(isset($_FILES['file'])) {
    $target_dir = "uploads/";
    $target_file = ($target_dir . time().'-' . basename($_FILES["file"]["name"]));
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
    if (file_exists($target_file)) {
        $msg = "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($_POST["file"]["size"] > 5000000) {
        $msg = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "zip" && $imageFileType != "rar") {
        $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $msg = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], ($target_file))) {
            $msg = "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
            file_put_contents($target_file. ".json", json_encode($_POST));
        } else {
            $msg = "Sorry, there was an error uploading your file.";
        }
    }

}
