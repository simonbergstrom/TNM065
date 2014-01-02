<?php

require_once 'twitter-api/TwitterAPIExchange.php';

//Function to take a snippet from blog message + url to blog and tweet it...

function sendtweet($message)
{
	$letters = array("å","ä","ö","Å","Ä","Ö");
	$replacers = array("&aring;","&auml;","&ouml;","&Aring;","&Auml;","&Ouml;");
	$info = "......http://www.student.itn.liu.se/~simbe109/TNM065/project/startpage.php";

	$resultmsg =  $message; 

	$resultmsg = substr($resultmsg,0,60); // shorten string to fit in a tweet plus the url



	$resultmsg = $resultmsg . $info; // add url
	$resultmsg = str_replace ($letters, $replacers, $resultmsg); // Trixar lite med å ä ö ...
	$resultmsg = utf8_encode($resultmsg);

	$settings = array(

		'oauth_access_token' => "382616554-IbswNNEAls5mm5x0NeEOQI3Jd2MudOtxF8tHmrRZ",
		'oauth_access_token_secret' => "fQUpwVyNbxeKeISQssVbKURuVmuvBkjTbY7aZ54hFyEJb",
		'consumer_key' => "wpBwxDw5In2jwrPcR7GMPg",
		'consumer_secret' => "37oecgdkOHsYx0WG0V14IhwowmzURW6a85Bz5RZtxT0"
	);

	$url = 'https://api.twitter.com/1.1/statuses/update.json';
	$requestMethod = 'POST';

	$twitter = new TwitterAPIExchange($settings);

	$postfields = array(
	    'status' => "$resultmsg" ); 

	 $twitter->buildOauth($url, $requestMethod)
	 ->setPostfields($postfields)
	 ->performRequest();
}
	 echo "<status> Tweet inlagt! </status>";





?>