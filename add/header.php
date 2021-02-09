<div class="navbar_container">
    <div class="navbar_holder">
        <div class="logo_intro">
            <img src="media/logo.png" alt="logo" id="logo-img">
            <h1>Random Projekt</h1>
            <?php
                session_start();
                if(isset($_SESSION["loggedin"])) {
                    echo '';
                } 
            ?>
            
        </div>
    </div>
</div>