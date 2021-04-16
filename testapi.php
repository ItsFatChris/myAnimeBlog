

<?php

/*
$arr = array("element1","element2",array("element31","element32"));
$arr['name'] = "response";
echo $_GET['callback']."(".json_encode($arr).");";
*/


//start php server
//php -S localHost:8000


//use easy http request
//$json = file_get_contents("https://www.thecocktaildb.com/api/json/v1/1/search.php?i=vodka");
//https://www.thecocktaildb.com/api/json/v1/1/random.php
$q=$_GET["q"];

$json = file_get_contents("https://api.jikan.moe/v3//search/anime/?q=$q&limit=3'");




$data = json_decode($json, true);

//echo $_GET['callback']."$data";
echo "<div>" ."<p>" . $data["results"][0]["title"] . "</p> <img src=\"" . $data["results"][0]["image_url"]. "\" alt=\"Girl in a jacket\"> " ."<p>" . "<input type=\"radio\" id=\"op1\" name=\"sel\" value=\"" . $data["results"][0]["mal_id"] . "\">" ."</div>" .
"<div>" ."<p>" . $data["results"][1]["title"] . "</p> <img src=\"" . $data["results"][1]["image_url"]. "\" alt=\"Girl in a jacket\"> " . "<input type=\"radio\" id=\"op2\" name=\"sel\" value=\"" . $data["results"][1]["mal_id"] . "\">" . "</div>" .
"<div>" ."<p>" . $data["results"][2]["title"] . "</p> <img src=\"" . $data["results"][2]["image_url"]. "\" alt=\"Girl in a jacket\"> " . "<input type=\"radio\" id=\"op3\" name=\"sel\" value=\"" . $data["results"][2]["mal_id"] . "\">" . "</div>"  ;
//echo "this is my text";


?>
