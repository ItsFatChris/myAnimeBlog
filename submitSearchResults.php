

<?php
$q=urlencode($_GET["q"]);

$json = file_get_contents("https://api.jikan.moe/v3/search/anime/?q=$q&limit=3");

$data = json_decode($json, true);


echo "<div id='results'> <div id='r1'>" ."<p id='result1'>" . $data["results"][0]["title"] . "</p> <img src=\"" . $data["results"][0]["image_url"]. "\" alt=\"Girl in a jacket\"> " ."<p>" . "<input type=\"radio\" id=\"op1\" name=\"sel\" value=\"" . $data["results"][0]["mal_id"] . "\">" ."</div>" .
"<div id='r2'>" ."<p id='result2'>" . $data["results"][1]["title"] . "</p> <img src=\"" . $data["results"][1]["image_url"]. "\" alt=\"Girl in a jacket\"> " . "<input type=\"radio\" id=\"op2\" name=\"sel\" value=\"" . $data["results"][1]["mal_id"] . "\">" . "</div>" .
"<div id='r3'>" ."<p id='result3'>" . $data["results"][2]["title"] . "</p> <img src=\"" . $data["results"][2]["image_url"]. "\" alt=\"Girl in a jacket\"> " . "<input type=\"radio\" id=\"op3\" name=\"sel\" value=\"" . $data["results"][2]["mal_id"] . "\">" . "</div></div>"  ;


?>
