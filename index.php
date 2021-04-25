<?php
include 'include.php';
include 'dbo.php';
include 'topbar.php';
function createThumb($row) {


}

?>
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
    

    if($result = mysqli_query($conn, $stmt)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $link = "article.php/?q=" . $row['articleID'];
                function firstSentence($content)
                    {
                        $pos = strpos($content, ".");

                        if($pos === false)
                            {
                                return $content;
                            }
                        else
                            {
                                return substr($content, 0, $pos+1);
                            }
                    }
            
                    echo "<div class = " . "RecentReviewShowsHere". ">";
                        echo "<table>";
                            echo "<tr>";
                                echo "<th colspan =" ."2". ">Headline : ". "<a href=" . $link . ">" . $row['articleTitle'] . "</a></th>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td> <img src=\"" . $row['imageURL']. "\" alt=\"Girl in a jacket\"> " ."</td>";
                                echo "<td> Anime Name : \n" . $row['animeName'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan = " .  "2" . ">" . firstSentence($row['body']) ."...</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan = " .  "2" . ">" .  $row['starRating'] ."/5 </td>";
                            echo "</tr>";
                        echo "</table>";
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

</body>

</html>