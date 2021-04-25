<?php
include 'dbo.php';
include 'include.php';
include "topbar.php";

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

                            CloseCon($conn);
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

<body>

<?php
  //  if($_SESSION["username"] != ""){
  //  echo "<h2> Username: " . $_SESSION["username"] . "</h2>";
  //  }
?>


<div class = "loginSignup">
   <h1>Sign-up as an Existing User</h1>
    <form action="" method="post" >
    <div class = "username">  
        <label>Username</label>
            </br>
            <input type = "text" name="username"></input>
            <?php if( $_SERVER["REQUEST_METHOD"] == "POST"){ if($usernameError != ""){ echo "<p>" . $usernameError . "</p>";}} ?>
    </div>
            </br>
    <div class = "password">  
        <label>Password</label>
            </br>
            <input type = "password" name="password"></input>
            <?php if( $_SERVER["REQUEST_METHOD"] == "POST"){ if($passwordError != ""){ echo "<p>" . $passwordError . "</p>";}} ?>
    </div>
            </br>
    <div class = "confirmPassword">  
        <label>Confirm Password</label>
            </br>
            <input type = "password" name="confirmPassword"></input>
            <?php if( $_SERVER["REQUEST_METHOD"] == "POST"){ if($confirmPasswordError!= ""){ echo "<p>" . $confirmPasswordError. "</p>";}} ?>
    </div>
            <br/>
    
    <div class = "signupActions">
            <input type="submit" name="submit" value="Sign Up" />
    <h3>Already have an account? Click <a href = "//localhost:8000/login.php">here </a> to login!</h3>
    </div>
    </form>
</div>

</body>
</html>