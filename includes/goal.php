<?php

session_start();
if(isset($_POST["content"])) {
    require "database.php";
    include "userdata.php";

    $me = new UserData();
    $me->getGoals($_SESSION["user_index"]);

    //Declaring variables
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $title = mysqli_real_escape_string($conn, $_POST["header"]);
    
    //The joinedTags will remain in its "joined" format even in the database
    //Whenever we need to access them, we'll simply run a method that will return an array of tags
    $joinedTags = mysqli_real_escape_string($conn, $_POST["tags"]);
    $goal_repeat = mysqli_real_escape_string($conn, $_POST["repeat"]);
    $goal_id = uniqid(" ", true);
    $goal_date = date('d m Y H:i:s');

    //Goal deadline is a feature that hasn't been created yet
    $goal_deadline = "not specified";

    if($me->goals !== "") {
        while($row = mysqli_fetch_assoc($me->goals)) {
            //Do something
        }
    }

    $stmt = $conn->prepare("INSERT INTO goals (goal_name, goal_deadline, goal_desc, goal_index, goal_date, goal_repeat)
    VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $goal_deadline, $content, $goal_id, $goal_date, $goal_repeat);
    $stmt->execute();

    
}