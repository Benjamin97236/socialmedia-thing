<?php
session_start();
$index = $_SESSION["user_index"];

if(isset($_POST["imagepath"]) || isset($_POST["username"])) {
    require "database.php";
    if(mysqli_real_escape_string($conn, $_POST["imagepath"]) && mysqli_real_escape_string($conn, $_POST["username"])) {
        $username = $_POST["username"];

        $imagePath = $_POST["imagepath"];
        $fileExt = explode(".", $imagePath);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "png", "gif", "jpeg");
        if(in_array($fileActualExt, $allowed)) {
            $fileNameNew = uniqid('', true).".".$fileActualExt;
        }

        $stmt = $conn->prepare("UPDATE users SET uname = ?, user_image = ? WHERE user_index = '$index'");
        $stmt->bind_param("ss", $username, $imagePath);
        if($stmt->execute()) {
            header("Location: ../user.php?id='$index'");
        }
    }
}