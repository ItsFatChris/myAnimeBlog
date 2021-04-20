<?php
//allows for login of users
include 'dbo.php';
include 'include.php';
$loginFail = false;

if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){

    $conn = OpenCon();

    

    //collect entered username and password
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $checkUser = "SELECT username, password, userID FROM USER WHERE username = '$username'";
    //execute the query
    if($getUsername = mysqli_query($conn, $checkUser)){
        
        //if there is a username match 
        if(mysqli_num_rows( $getUsername) > 0){
            $row = mysqli_fetch_array($getUsername);
            //check to see if the password matches
            echo "<p>" . password_hash($password, PASSWORD_DEFAULT) . "</p>";
            if(password_verify($password, $row['password'])){
                //add the username and userID to the session variables
                echo "<p>login successful</p>";
                $userID = $row['userID'];
                $_SESSION["username"] = "$username";
                $_SESSION["userID"] = $userID;
                $_SESSION["loggedIn"] = true;
                CloseCon($conn);
                            header("location: index.php");
            } else {
                echo "<p>Loging unsuccessful</p>";
                $loginFail = true;
            }


            

        
        } else {
            echo "<p>Loging unsuccessful</p>";
                $loginFail = true;
        } 

 

    }
    

    
    CloseCon($conn);


}
//if logout is pressed then destroy the session
if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])){
    header("location: logout.php");
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
    echo "<h2> UserID: " . $_SESSION["userID"] . "</h2>";
    }


?>
<h1> Log IN </h1>
    <?php
    include "topbar.php";
    ?>

   <form action="" method="post" >

                        
   <label>Username</label>
                        </br>
                        <input type = "text" name="username"></textarea>
                        </br>
                        <label>Password</label>
                        </br>
                        <input type = "password" name="password"></textarea>
                        </br>
                        <br/>
                        <input type="submit" name="login" value="Login" />

                    </form>
            <form action="" method="post" >

                        
                        
                        <br/>
                        <input type="submit" name="logout" value="Log Out" />

                    </form>
                    <?php if($loginFail){ echo "<p>Either Username or Password are incorrect</p>";} ?>
  

</body>
</html>