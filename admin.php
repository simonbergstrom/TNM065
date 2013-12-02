<?php 
$debug=0;

if($debug){
	header("Content-type:text/xml;charset=utf-8");
}else {
	include("prefix.php");
}?>

<!DOCTYPE blog SYSTEM "blog.dtd"[

	<!ENTITY aring "&#229;"> 
	<!ENTITY Aring "&#197;"> 
	<!ENTITY ouml "&#246;"> 
	<!ENTITY Ouml "&#214;">
	<!ENTITY auml "&#228;">
	<!ENTITY Auml "&#196;">
]>




<blog>
<post><title>Fyll i titel:</title>
<text>Skriv ditt inl&auml;gg:</text>
<signature>Din signatur: </signature>
<test>
<?php
	$link = mysql_connect("localhost", "root", "root")
        or die("Could not connect");
     
    mysql_select_db("tnm065")
        or die("Could not select database");
    $returnstring ="";
 

		$title = $_POST["title"]; $text= $_POST["textarea"]; $signature=$_POST["signature"]; 
	    
		$now = new DateTime();
		$now->format('Y-m-d H:i:s');    // MySQL datetime format
		$now->setTimezone(new DateTimeZone('Europe/Stockholm'));
		$date = $now->getTimestamp(); 


	      $query = "INSERT INTO post(title,text,signature)
          VALUES ('$title','$text','$signature')";

     	if($_POST["title"] != "Fyll i....." && $_POST["textarea"] != "Fyll i....." && $_POST["signature"] != "Fyll i....." && isset($_POST["submitbtn"]))
     	{
	    	$result = mysql_query($query)
	    	or die("Query failed");	

	    	if(!mysql_errno())
    		print "Posten &auml;r inlagd!";
     	}
     	else
     		;
?>
</test>


<date> <?php print date('Y-m-d h:m:s',$date) ?> </date>


</post>
</blog>



<?php
if(!($debug)){
	include("postfix1.php");
} ?>