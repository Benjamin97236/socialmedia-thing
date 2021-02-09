<div class="navbar_container">
    <div class="navbar_holder">
        <div class="navbar_box1">
            <img src="media/logo-shit.png" alt="logo" id="logo-img">
            <form action="includes/logout.php" method="post">
                <input type="submit" name="submit" value="Logga ut" class="regular_button">
            </form>
        </div>
        <div class="navbar_box2">
            
        </div>
        <div class="navbar_box3">
            <?php echo '<h1 style="color: rgb(48, 199, 48);">'.$_SESSION["username"].'</h1>'; ?>
            <?php
                if(isset($me->user_image)) {
                    echo '<img src="media/'.$me->user_image.'" alt="profile-pic" id="user-img">';
                } else {
                    echo '<img src="media/user.png" alt="user" id="user-img">';
                }
            
            ?>
        </div>
    </div>
</div>