<?php 
$debug=0;

if($debug){
	header("Content-type:text/html;charset=utf-8");
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


<?php
	$con=mysql_connect("localhost", "root", "root")
        or die("Could not connect");

    mysql_select_db("project")
        or die("Could not select database");

	$source = array();
	$bildtext = array();
	$value;


if(isset($_POST['bild'])) {

			$value = $_POST['pic'];
			$returnstring ="";
		
			for($i = 0; $i<$value ; $i++)
			{	
				$returnstring = $returnstring . "<image>";
				$returnstring = $returnstring . "<src>source$i</src>";
				$returnstring = $returnstring . "<imagetext>text $i</imagetext>";
				$returnstring = $returnstring . "</image>";		
			}
			
		print utf8_encode($returnstring); 
}
	
if (isset($_POST['submitbild'])) {
		$returnstring ="";
		
	//	$P = "0";
	//	$tes = $_POST['source' . $P];

	for($j = 0; $j < 1; $j++)
	{	

		
		//$returnstring = $returnstring . "<test>";
		array_push($source, $_POST['source' . $j]);
		array_push($bildtext, $_POST['bildtext' . $j]);
		//$returnstring = $returnstring . "$source[$j]";
		//$returnstring = $returnstring . "</test>";	
	}
		
		print utf8_encode($returnstring); 
}

if (isset($_POST['submitbtn'])) {
		$title = $_POST['title'];
		$title = htmlspecialchars($title);
		$text = $_POST['textarea'];
		$text = htmlspecialchars($text);
		$signature = $_POST['signature'];
		$signature = htmlspecialchars($signature);
		$dat = date('Y-m-d');


	if($title != "" && $text != "" && $signature != "" )
	{
		$sql = "INSERT INTO post (date, signature, title, text )
		VALUES ('$dat', '$signature', '$title', '$text')";
		$result = mysql_query($sql);


		$returnstring ="";
		$id = "1";
		for($k = 0; $k < 1 ; $k++)
		{
		$returnstring = $returnstring . "<test>";
		$returnstring = $returnstring . "HEJ ; '$source[$k]'";
		$sorc = "$source[$k]";
		$bldt = "$bildtext[$k]";
		$returnstring = $returnstring . "</test>";	
		$seq = "INSERT INTO image (path, pictext, ID)
		VALUES ('$sorc', '$bldt', '$id')";
		$res = mysql_query($seq);
		
		}
		print utf8_encode($returnstring); 
	}

	if(!$res)
	{
		echo "error bild";
	}

	if(!$result){
	echo "Error";
	}

}
	
?>





</post>
</blog>



<?php
if(!($debug)){
	include("postfix1.php");
} ?> 