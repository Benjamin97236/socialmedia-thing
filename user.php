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

    require "includes/userdata.php";
    $me = new UserData();
    $me->getInfo($_SESSION["user_index"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.user.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Ubuntu&display=swap" rel="stylesheet">
    <title><?php echo $_SESSION["username"]; ?></title>
</head>
<body>

<?php
    if(!isset($_SESSION["user_index"])) {
        header("Location: index.php?error=noaccount");
    }

?>

    <section class="navbar">
        <?php include "add/navbar.user.php"; ?>
    </section>
    
    <section class="bodycontent">
        <div class="bodycontent_container">
            <div class="bodycontent_holder">
                <div class="left_section">
                    <div class="profile_settings_holder">
                        <div class="profile_img_holder">
                            <?php
                                if(isset($me->user_image)) {
                                    echo '<img src="media/'.$me->user_image.'" alt="profile-pic" id="big-user-img">';
                                } else {
                                    echo '<img src="media/user.png" alt="user" id="big-user-img">';
                                }       
                            ?>
                            <br>
                            <br>
                        </div>

                        <div style="width: auto;">
                            <input type="file" name="filepath" id="file-input">
                        </div>

                        <div class="username_holder">
                            <p>Ändra ditt användarnamn</p>
                            <input type="text" name="username" id="change-username-input" placeholder="<?php echo $me->uname; ?>">
                        </div>
                        <div class="save_buttons_holder">
                            <button id="save-btn">Spara</button>
                            <button id="cancel-btn">Rensa</button>
                        </div>
                    </div>
                </div>
                <div class="right_section">
                    <div class="buttons_holder">
                        <button>Nytt mål</button>
                        <button>Mina mål</button>
                        <button>Uppnådda mål</button>
                    </div>
                    <br>
                    <br>
                    <div class="new_post_container">
                        <h1 id="headertext">Känner du för uppdatering?</h1>
                        <div class="content_manager_post">
                            <input type="text" placeholder="Skriv här..." id="header-input">
                        </div>
                        <div class="content_manager_post">
                            <textarea name="content" id="content-textarea" placeholder="Skriv här..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="js/script.js"></script>
</body>
</html>