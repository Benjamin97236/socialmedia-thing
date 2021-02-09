<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Blog</title>
</head>
<body>

    <section class="navbar">
        <?php include "add/header.php"; ?>
    </section>
    <section class="bodycontent">
        <div class="bodycontent_container">
            <div class="login_signup_container">
                <div class="login_container">
                    <form action="includes/login.php" method="post">
                        <h1>Logga in:</h1>
                        <br>
                        <p>Användarnamn:</p>
                        <input type="text" name="username">

                        <p>Lösenord:</p>
                        <input type="password" name="password">
                        <input type="submit" name="submit" value="logga in">
                    </form>
                </div>

                <div class="login_container">
                    <form action="includes/signup.php" method="post">
                        <h1>Skapa konto:</h1>
                        <br>
                        <p>Användarnamn:</p>
                        <input type="text" name="username">

                        <p>Lösenord:</p>
                        <input type="password" name="password">
                        <input type="submit" name="submit" value="logga in">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="footer">
        <?php include "add/footer.php"; ?> 
    </section>  
    
    <script src="js/script.index.js"></script>
</body>
</html>