<?php

require_once 'twitter.class.php';


echo "<h2> Twittertest </h2>";

$accessToken = "382616554-SYg1jqc609qEa5Go9N9le3sTLKkol9aUE5tws5aY";
$accessTokenSecret = "xQlbK85PDcEWTQvf64IxyYrowbOlfhL8R9zrDH25bPn7j";
$consumerKey = "wpBwxDw5In2jwrPcR7GMPg";
$consumerSecret = "37oecgdkOHsYx0WG0V14IhwowmzURW6a85Bz5RZtxT0";

$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$status = $twitter->send('I am fine');

echo $status ? 'OK' : 'ERROR';


?>