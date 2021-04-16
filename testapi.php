

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
echo "<p>" . $data["results"][0]["title"] . "</p> <img src=\"" . $data["results"][1]["image_url"]. "\" alt=\"Girl in a jacket\"> ";
//echo "this is my text";


?>
