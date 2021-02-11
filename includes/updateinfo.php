<?php
session_start();
$index = $_SESSION["user_index"];

if(isset($_POST["submit"])) {
    require "database.php";
    include "userdata.php";
    $me = new UserData();
    $me->getInfo($index);

    $username = mysqli_real_escape_string($conn, strval($_POST["username"]));


    function processFile($file) {
        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileError = $file["error"];
        $fileSize = $file["size"];
        $fileType = $file["type"];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "png", "gif", "jpeg");
        if($fileError === 0) {
            if($fileSize < 5000000) {
                if(in_array($fileActualExt, $allowed)) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "../profile-pictures/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    return $fileNameNew;
                }
            }
        }
    }

    function updateUserData($uname, $image, $connection, $id) {
        $stmt = $connection->prepare("UPDATE users SET uname = ?, user_image = ? WHERE user_index = ?");
        $stmt->bind_param("sss", $uname, $image, $id);
        if($stmt->execute()) {
            header("Location: ../user.php?id=$id");
        }
    }

    $fileActualName = $me->user_image;

    if($_FILES["imagepath"]["size"] !== 0 && $_FILES["imagepath"]["error"] == 0) {
        if($fileActualName = processFile($_FILES["imagepath"])) {
            
        }
    } 


    if($_POST["username"] == NULL) {
        $username = $me->uname;
    }
    
    updateUserData($username, $fileActualName, $conn, $index);

}