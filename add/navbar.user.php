<div class="navbar_container">
    <div class="navbar_holder">
        <div class="navbar_box1">
            <img src="media/logo-shit.png" alt="logo" id="logo-img">
            <form action="includes/logout.php" method="post">
                <input type="submit" name="submit" value="Log out" class="regular_button">
            </form>
        </div>
        <div class="navbar_box2">
            <p id="clock"></p>
        </div>
        <div class="navbar_box3">
            <?php echo '<h1 style="color: rgb(202, 136, 233);">'.$_SESSION["username"].'</h1>'; ?>
            <?php
                if(isset($me->user_image)) {
                    echo '            <div class="profile_pic_container">
                        <img src="profile-pictures/'.$me->user_image.'" alt="profile-pic" id="user-img">
                    </div>';
                } else {
                    echo '<div class="profile_pic_container">
                    <img src="media/user.png" alt="profile-pic" id="user-img">
                </div>';
                }
            
            ?>
        </div>
    </div>
</div>