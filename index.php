<?php
//home page doesnt do anything yet
include 'include.php';
include 'dbo.php';
function createThumb($row) {


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
   <h1> Home Page </h1>
   <?php
    include "topbar.php";

    $conn = OpenCon();
    $stmt = "SELECT * FROM article ORDER BY date DESC LIMIT 10";

    if($result = mysqli_query($conn, $stmt)){
        if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Picture</th>";
                echo "<th>Title/LinkToArticle</th>";
                echo "<th>UserName</th>";
                echo "<th>StarRating</th>";
                echo "<th>AnimeName</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            $link = "article.php/?q=" . $row['articleID'];
            //<a href=$link >$row['articleTitle']</a>



            //"https://api.jikan.moe/v3/anime/"
            echo "<tr>";
                echo "<td> <img src=\"" . $row['imageURL']. "\" alt=\"Girl in a jacket\"> " ."</td>";
                echo "<td>" . "<a href=" . $link . ">" . $row['articleTitle'] . "</a> ". "</td>";
                echo "<td>" . $row['userID'] . "</td>";
                echo "<td>" . $row['starRating'] . "</td>";
                echo "<td>" . $row['animeName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    }
}







    ?>

</body>

</html>