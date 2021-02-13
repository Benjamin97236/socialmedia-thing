<?php
    include "includes/database.php";
    session_start();
    //Checking if user is logged in
    if(!$_SESSION["loggedin"]) {
        //If not, then get redirected back to index.php
        header("Location: index.php?error=noaccount");
    }
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
                                    echo '<img src="profile-pictures/'.$me->user_image.'" alt="profile-pic" id="big-user-img">';
                                } else {
                                    echo '<img src="media/user.png" alt="user" id="big-user-img">';
                                }       
                            ?>
                            <br>
                            <br>
                        </div>
                        <form action="includes/updateinfo.php" method="post" enctype="multipart/form-data">
                            <div style="width: auto;">
                                <input type="file" name="imagepath" id="file-input">
                            </div>

                            <div class="username_holder">
                                <p>Change username</p>
                                <input type="text" name="username" id="change-username-input" placeholder="<?php echo $me->uname; ?>">
                            </div>
                            <div class="save_buttons_holder">
                                <input type="submit" id="save-btn" name="submit" class="save-cancel-button" value="Save">
                                <input type="button" id="cancel-btn" class="save-cancel-button" value="Restart">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="right_section">
                    <div class="buttons_holder">
                        <div class="buttons_holder_actual">
                            <button>New goal</button>
                            <button>My goals (0)</button>
                            <button>Achieved goals (0)</button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="new_goal_container regular_container">
                        <h1 id="headertext">Want to set a new goal?</h1>
                        <div class="goal_container_visibility">
                            <div class="goal_set_container post_goal_container">
                                <p id="chars-header-input">0/20</p>
                                <input type="text" placeholder="Title.." id="header-input" class="input_goal" autocomplete="off">
                            </div>

                            <div class="goal_set_container post_goal_container">
                                <p id="chars-goal-input">0/5</p>
                                <input type="text" placeholder="Tags e.g., #cars" id="goal-input-tags" class="input_goal" autocomplete="off">
                                <div class="actual_tag_holder">
                                    
                                </div>
                            </div>
                            <p id="tags-goal-error-msg"></p>

                            <div class="goal_set_container post_goal_container">
                                <p id="chars-textarea">0/500</p>
                                <textarea name="content" id="content-textarea" placeholder="Description..." class="input_goal"></textarea>
                            </div>
                            <p>Repeat:</p>
                            <div class="goal_set_container post_goal_container">
                                <div class="options_container_goal">
                                    <input type="checkbox" name="repeat-goal-daily" class="new_goal_boxes" id="box1">
                                    <label for="repeat-goal-daily" style="margin-right: 10px;">Every day</label>

                                    <input type="checkbox" name="repeat-goal-weekdays" class="new_goal_boxes" id="box2">
                                    <label for="repeat-goal-weekdays" style="margin-right: 10px;">Week days</label>

                                    <input type="checkbox" name="repeat-goal-never" class="new_goal_boxes" id="box3">
                                    <label for="repeat-goal-never" style="margin-right: 10px;">Long term (once)</label>

                                    <input type="hidden" name="repeat" value="">

                                    <button class="smaller-button" id="createGoalBtn" style="background-color: lightgreen; border: 1px solid green;">Get going!</button> 
                                </div>
                            </div>
                            <p id="submit-goal-error"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer">
        <?php
            include "add/footer.php";
        ?>
    </section>


    <script src="js/script.js"></script>
    <script src="js/creategoal.js"></script>
</body>
</html>