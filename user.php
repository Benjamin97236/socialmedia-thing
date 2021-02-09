<?php
    include "includes/database.php";
    session_start();
    $_SESSION["user_index"] = $_GET["id"];
    $user_id = $_GET["id"];

    $sql = "SELECT * FROM users WHERE user_index = '$user_id'";

    $result = mysqli_query($conn, $sql); 
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $username = $row["uname"];
            $created_at = $row["created_at"];
            //more soon (image, description etc)    
        }
        $_SESSION["username"] = $username;
    } else {
        die("There weren't enough results in the database :(");
    }
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.user.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title><?php echo $_SESSION["username"]; ?></title>
</head>
<body>

    <section class="navbar">
        <?php include "add/navbar.user.php"; ?>
    </section>
    
    <section class="bodycontent">
        <div class="bodycontent_container">
            <div class="bodycontent_holder">
                <div class="left_section">

                </div>
                <div class="right_section">

                </div>
            </div>
        </div>
    </section>


</body>
</html>