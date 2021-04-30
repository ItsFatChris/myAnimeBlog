<?php
    include 'dbo.php';
    include 'include.php';
    include "topbar.php";
?>


    <?php
    
    echo "<div class = ". "userReviewPage" . ">";
        $matchFound = (isset($_GET["q"]));
        if($matchFound) 
            {
                $q=urlencode($_GET["q"]);
                $conn = OpenCon();

                $stmt = $conn->prepare("SELECT * FROM ARTICLE  WHERE articleID = ?");
                $stmt->bind_param("s", $q);
                $stmt->execute();


                $result = $stmt->bind_result($articleID, $articleTitle, $userID, $animeID, $starRating,$body, $date, $imageURL, $animeName);
                $stmt->fetch();
                if($articleID != "")
                    {   
                        echo "<img src=\"". $imageURL . "\"alt="."animeCover"." class = " ."coverImg". ">";
                        echo "<table class =" . "animeInfo" . ">";
                            echo "<tr>";
                                echo "<td colspan = 2> Anime Name : " . $animeName . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan = 2>Headline : " . $articleTitle . "</td>";
                            echo "</tr>";
                            /*echo "<tr>";
                                echo "<td colspan = 2>By : " . $username . "</td>";
                            echo "</tr>";*/
                            echo "<tr>";
                                echo "<td colspan = 2>Body : " .  nl2br($body). "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td>User Rating : " .  $starRating. "/5</td>";
                                echo "<td>User Date Submitted : " .  $date . "</td>";
                            echo "</tr>";                            
                        echo "</table>";
                        echo "</div>";

                        /*echo "<p>ArticleID: " . $articleID . "<br>Article Title: " . $articleTitle . "<br> UserID: " . $userID . "<br> AnimeID:" . $animeID . "<br>Body: <br>" .  nl2br($body) . "<br><br>User Rating:" . $starRating . "/5<br>Date Submitted:" . $date . "</p>";
                       */
                        $stmt->close();
                        CloseCon($conn);
                    } 
                else 
                    {
                        echo "<p>No results found</p>";
                        $stmt->close();
                        CloseCon($conn);
                    }
    
            } 
        else 
            {
                header("location: //localhost:8000/index.php");
            }

    echo "</div>";

    ?>
