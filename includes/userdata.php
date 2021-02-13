<?php
//Creating the class UserData
class UserData {

    public function getInfo($id) {
        require "database.php";
        //Getting values from database
        if(mysqli_real_escape_string($conn, $id)) {
            //This query will get all information from a specific user
            $sql = "SELECT * FROM users WHERE user_index = '$id'";  
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    //Assigning values from db to private variables
                    $username = $row["uname"];
                    $created_at = $row["created_at"];
                    $user_image = $row["user_image"];

                    //Setting class properties
                    $this->uname = $username;
                    $this->created = $created_at;
                    $this->user_image = $user_image;

                    return true;
                }
            } else {
                return false;   
            }
        }
    }

    //This function will give us an array
    public function getGoals($id) {
        require "database.php";
        if(mysqli_real_escape_string($conn, $id)) {
            //This query will get all information from a users goals
            $sql = "SELECT * FROM goals WHERE from_user = '$id'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                $this->goals = $result;
            } else {
                $this->goals = "";
            }
        }
    }

    //This function will return amount of posts from user
    public function userPosts($id) {
        require "database.php";
        $sql = "SELECT * FROM posts WHERE from_user = '$id'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        //Create variable from resultCheck
        $userPostAmount = strval($resultCheck);
        //Check if there are any posts at all
        if($resultCheck > 0) {
            //If there are, set property "posts_amount" to variable userPostAmount
            $this->posts_amount = $userPostAmount;
        } else {
            //If not, set property "posts_amount" to 0
            $this->posts_amount = 0;
        }
    }
}

