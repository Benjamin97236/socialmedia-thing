<div class="navbar_container">
    <div class="navbar_holder">
        <div class="navbar_box1">
            <h1>Logo/namn</h1>
            <form action="includes/logout.php" method="post">
                <input type="submit" name="submit" value="Logga ut" class="regular_button">
            </form>
        </div>
        <div class="navbar_box2">
            <input type="text" placeholder="Sök...">
        </div>
        <div class="navbar_box3">
            <?php echo '<h1>'.$_SESSION["username"].'</h1>'; ?>
        </div>
    </div>
</div>