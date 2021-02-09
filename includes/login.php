<?php

    if(isset($_POST["submit"])) {
        require "database.php";
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        if(!preg_match("[^A-Za-z0-9.#\-$]", $username) && !preg_match("[^A-Za-z0-9.#\-$]", $password)) {
            
            $sql = "SELECT uname, user_pwd, user_index FROM users";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $db_username = $row["uname"];
                    $db_password = $row["user_pwd"];
                    if($username == $db_username && $password == $db_password) {
                        $user_id = $row["user_index"];
                        header("Location: ../user.php?id=$user_id");
                    } else {
                        header("Location: ../index.php?error=wronginfo");
                    }
                }
            }
        } else {
            header("Location: ../index.php?error=invalidchars");
        }
    }
