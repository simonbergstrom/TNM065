<?php
require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/

$settings = array(
    'oauth_access_token' => "382616554-SYg1jqc609qEa5Go9N9le3sTLKkol9aUE5tws5aY",
    'oauth_access_token_secret' => "xQlbK85PDcEWTQvf64IxyYrowbOlfhL8R9zrDH25bPn7j",
    'consumer_key' => "wpBwxDw5In2jwrPcR7GMPg",
    'consumer_secret' => "37oecgdkOHsYx0WG0V14IhwowmzURW6a85Bz5RZtxT0"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";

if (isset($_GET['user'])) {$user = $_GET['user'];} else {$user = "iagdotme";}
if (isset($_GET['count'])) {$user = $_GET['count'];} else {$count = 20;}
$getfield = "?screen_name=$user&count=$count";


$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
/*echo "<pre>";
print_r($string);
echo "</pre>";*/

foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br />";
    }

?>



