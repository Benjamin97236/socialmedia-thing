<?php

include "database.php";

if(isset($_POST["submit"])) {
    $stmt = $conn->prepare("INSERT INTO users(uname, user_pwd, user_index, created_at) VALUES(?, ?, ?, ?)");
    if(!$stmt) {
        die("An error occured (stmt - signup)");
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    $user_id = uniqid('', true);
    $date = date('d m Y H:i:s');
    
    $stmt->bind_param("ssss", $username, $password, $user_id, $date);
    if ($stmt->execute()) {
        session_start();
        header("Location: ../user.php?id=$user_id");
    }
}