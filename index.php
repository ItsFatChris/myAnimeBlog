<?php
include 'include.php';
include 'dbo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Anime General</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Chango&family=Roboto&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Antonio&family=Montserrat:ital,wght@0,300;0,400;1,200;1,300;1,400&family=Ranga:wght@400;700&family=Roboto:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
   <link rel="stylesheet" type = "text/css" href="../../../styles.css" />

</head>

<header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="//localhost:8000/index.php">Anime General</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <?php
                if($_SESSION["username"] != "")
                    {
                        echo  "<a class = nav-link> Welcome ". $_SESSION["username"] . "</a>";
                    }
                else 
                    {
                        echo "<a class= nav-link" ." href=". "//localhost:8000/login.php> Login/Signup ". "</a>";
                    }
            ?>
            <!--<a class="nav-link" href="//localhost:8000/Login-page.php">Login/Signup </a>-->          
        </li>
    </div>
</header>

<body>
   
   <!--Tried getting a backgroundimage-->            
   <!--<div class = "bg"></div>-->
    <h2>
        <nav id="secondaryNav">
            <ul> 
               
               <?php
                if($_SESSION["username"] != "")
                    {
                      echo "<li><a href="."//localhost:8000/about.php" .">About Us</a>|<a href=". "//localhost:8000/submitArticle.php". ">Submit A Review</a>|<a href=//localhost:8000/logout.php> Log out</a></li>";
                    }
                else 
                    {
                        echo "<li><a href="."//localhost:8000/about.php" .">About Us</a>|<a href=". "//localhost:8000/submitArticle.php". ">Submit A Review</a></li>";
                    }
               ?>
            </ul>  
        </nav>
    </h2>

    <div id="myDiv">
    <br><br><br><br><br>
    <form action="" method="post" >
        <label for="fname">Search:</label>
         <input type="text" id="fname" name="fname">
            <input type="submit" name="submit" value="Submit" />
    </form>
   <!--<p> <a href="//localhost:8000/signup.php"> Sign Up </a> </p>
   <p> <a href="//localhost:8000/login.php"> Login </a> </p> 
   <p> <a href="//localhost:8000/logout.php"> LogOut </a> </p>
   <p> <a href="//localhost:8000/index.php"> Home </a> </p>-
   <p> <a href="//localhost:8000/article.php?q=6"> Article</a> </p>
   <p> <a href="//localhost:8000/search.php"> Search</a> </p> -->
    
   <?php
    $conn = OpenCon();
    $stmt = "SELECT * FROM article ORDER BY date DESC LIMIT 10";
    //Attempted to perform a username search
    //$findUser = "SELECT username FROM user WHERE user.userID = article.userID ORDER BY date DESC LIMIT 10";

    if($result = mysqli_query($conn, $stmt /* && $result2 = mysqli_query($conn, $findUser)*/)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
              //  $userSearch = mysqli_fetch_array($result2);
                $link = "article.php/?q=" . $row['articleID'];
                    echo "<div class = " . "RecentReviewShowsHere". ">";
                        echo "<table>";
                            echo "<tr>";
                                echo "<td rowspan = 4> <img src=\"" . $row['imageURL']. "\" alt=\"Girl in a jacket\"> " ."</td>";
                                echo "<td>Headline : ". "<a href=" . $link . ">" . $row['articleTitle'] . "</a></th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td> Anime Name : \n" . $row['animeName'] . "</td>";
                            echo "</tr>";
                        /*    echo "<tr>";
                                echo "<td>By : ". $userSearch['username'] . "</a></th>";
                            echo "</tr>";  */                          
                            echo "<tr>";
                                echo "<td colspan = " .  "2" . "> User Rating : " .  $row['starRating'] ."/5 </td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td> Review : " . firstSentence($row['body']) ." <a href=" . $link . ">(See More)"."</a></td>";
                            echo "</tr>";
                        echo "</table><br>";
                    echo "</div>";
            /*
                echo "<th>Title/LinkToArticle</th>";
                echo "<th>UserName</th>";
                echo "<th>StarRating</th>";
                echo "<th>AnimeName</th>";
            echo "</tr>";
            */
            //<a href=$link >$row['articleTitle']</a>



            //"https://api.jikan.moe/v3/anime/"
            /*echo "<tr>";
                echo "<td> <img src=\"" . $row['imageURL']. "\" alt=\"Girl in a jacket\"> " ."</td>";
                echo "<td>" . "<a href=" . $link . ">" . $row['articleTitle'] . "</a> ". "</td>";
                echo "<td>" . $row['userID'] . "</td>";
                echo "<td>" . $row['starRating'] . "</td>";
                echo "<td>" . $row['animeName'] . "</td>";
            echo "</tr>";*/
        }
        
        // Free result set
        mysqli_free_result($result);
    }
}

    $conn -> close();
    ?>




</div>

</body>