<div class="navbar_container">
    <div class="navbar_holder">
        <div class="logo_intro">
        <img src="media/logo-shit.png" alt="logo" id="logo-img">
            <?php
                session_start();
                if(isset($_SESSION["loggedin"])) {
                    echo '';
                } 
            ?>
            
        </div>
    </div>
</div>