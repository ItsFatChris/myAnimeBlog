
<?php
 include 'dbo.php';
 include 'include.php';
 include "topbar.php";

$q=urlencode($_GET["q"]);

$json = file_get_contents("https://api.jikan.moe/v3/search/anime/?q=$q&limit=10");

$data = json_decode($json, true);
$size = sizeOf($data["results"]);
$array = [];
for($i =0; $i < $size; $i++){
    $array[$i] =$data["results"][$i]["mal_id"];
}

$sql = "SELECT * FROM article WHERE animeID IN ('" 
. implode("','", $array) 
     . "')";

     $findUser = "SELECT username FROM user,article WHERE user.userID = article.userID";

$conn = OpenCon();
//$stmt = "SELECT * FROM article ORDER BY date DESC LIMIT 10";

echo "<div id='searchResults'>";
if($result = mysqli_query($conn, $sql)){


    if ($userSearch = mysqli_query($conn, $findUser)) /* && $result2 = mysqli_query($conn, $findUser)))*/
    {
        if(mysqli_num_rows($result) > 0)
            {
                if(mysqli_num_rows($userSearch) > 0)
                    {
                        while($row = mysqli_fetch_array($result))
                            if($userRow = mysqli_fetch_array($userSearch))
                                {
                                    //$userSearch =  mysqli_query($conn, $findUser);
                                    $link = "article.php/?q=" . $row['articleID'];
                                        echo "<div class = " . "RecentReviewShowsHere". ">";
                                            echo "<table>";
                                                echo "<tr>";
                                                    echo "<td rowspan = 5> <img src=\"" . $row['imageURL']. "\" alt=\"Girl in a jacket\"> " ."</td>";
                                                    echo "<td>Headline : ". "<a href=" . $link . ">" . $row['articleTitle'] . "</a></th>";
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td> Anime Name : \n" . $row['animeName'] . "</td>";
                                                echo "</tr>";
                                                echo "<tr>";
                                                    echo "<td>By : ". $userRow['username'] . "</td>";
                                                echo "</tr>";      
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
            }





    /*

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

*/
}

echo "</div>";
/*
//echo $_GET['callback']."$data";
echo "<div>" ."<p id='result1'>" . $data["results"][0]["title"] . "</p> <img src=\"" . $data["results"][0]["image_url"]. "\" alt=\"Girl in a jacket\"> " ."<p>" . "<input type=\"radio\" id=\"op1\" name=\"sel\" value=\"" . $data["results"][0]["mal_id"] . "\">" ."</div>" .
"<div>" ."<p id='result2'>" . $data["results"][1]["title"] . "</p> <img src=\"" . $data["results"][1]["image_url"]. "\" alt=\"Girl in a jacket\"> " . "<input type=\"radio\" id=\"op2\" name=\"sel\" value=\"" . $data["results"][1]["mal_id"] . "\">" . "</div>" .
"<div>" ."<p id='result3'>" . $data["results"][2]["title"] . "</p> <img src=\"" . $data["results"][2]["image_url"]. "\" alt=\"Girl in a jacket\"> " . "<input type=\"radio\" id=\"op3\" name=\"sel\" value=\"" . $data["results"][2]["mal_id"] . "\">" . "</div>"  ;
//echo "this is my text";

*/

?>