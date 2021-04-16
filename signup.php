<?php
include 'dbo.php';
include 'include.php';

if( $_SERVER["REQUEST_METHOD"] == "POST"){

    $conn = OpenCon();
    //errors
    $usernameError = $passwordError = $confirmPasswordError = "";

    //collect entered username and password
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $checkUser = "SELECT username  FROM USER WHERE username = '$username'";
    //check to see if the username exists
    if($usernameExists = mysqli_query($conn, $checkUser)){
        //if it does
        if(mysqli_num_rows( $usernameExists) > 0){
            //
            //try to do this in javascript(live update)
            //
            //tell the user that they need to pick a new username
            $usernameError = "The username is already taken";
        } else {
            //if it doesnt then check password
            if(strlen($password) >= 8){
                if($password == $confirmPassword){
                    $sql = "INSERT INTO USER ( username, password ) VALUES('$username', '$passwordHash')";
                    //Execute the sql query, with our connection, and sql statement, and return the results
                    if($result = mysqli_query($conn, $sql)){
                        echo "<p> posted <p>";
                    }
                    $checkUser = "SELECT username, userID FROM USER WHERE username = '$username'";
        
                    if($getUsername = mysqli_query($conn, $checkUser)){
                
                        if(mysqli_num_rows( $getUsername) > 0){
                        $row = mysqli_fetch_array($getUsername);
                            echo "<p>login successful</p>";
                             $userID = $row['userID'];
                            $_SESSION["username"] = "$username";
                            $_SESSION["userID"] = $userID;
                            $_SESSION["loggedIn"] = true;

                            header("location: index.php");
                        
        
        
                
                        } 
        
         
        
                    }
                } else {
                    $confirmPasswordError = "Passwords must match";
                }
            }else {
                $passwordError = "Passwords must be at least 8 characters long";
            }

           
        }

 

    }
    

    
    CloseCon($conn);


}


?>







<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Chapter 5</title>
 
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Chango&family=Roboto&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="styles.css" />

</head>
<body>
<?php
    if($_SESSION["username"] != ""){
    echo "<h2> Username: " . $_SESSION["username"] . "</h2>";
    }


?>
   <h1> sign up </h1>
   <?php
    include "topbar.php";
    ?>
   <form action="" method="post" >

                        <label>Username</label>
                        </br>
                        <input type = "text" name="username"></input>
                        <?php if( $_SERVER["REQUEST_METHOD"] == "POST"){ if($usernameError != ""){ echo "<p>" . $usernameError . "</p>";}} ?>
                        </br>
                        <label>Password</label>
                        </br>
                        <input type = "password" name="password"></input>
                        <?php if( $_SERVER["REQUEST_METHOD"] == "POST"){ if($passwordError != ""){ echo "<p>" . $passwordError . "</p>";}} ?>
                        </br>
                        <label>Confirm Password</label>
                        </br>
                        <input type = "password" name="confirmPassword"></input>
                        <?php if( $_SERVER["REQUEST_METHOD"] == "POST"){ if($confirmPasswordError!= ""){ echo "<p>" . $confirmPasswordError. "</p>";}} ?>
                        <br/>
                        <input type="submit" name="submit" value="Sign Up" />

                    </form>
  

</body>
</html>