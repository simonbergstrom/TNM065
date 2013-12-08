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
<?php

	$link = mysql_connect("localhost", "root", "root")
        or die("Could not connect");
     
    mysql_select_db("project")
        or die("Could not select database");
    $returnstring ="";

	 // Inialize session
	session_start();

	// Check, if username session is NOT set then this page will jump to login page
	if (!isset($_SESSION['username'])) 
	{
		header('Location: startpage.php');
	}

		$title = $_POST["title"]; $text= $_POST["textarea"]; $signature=$_POST["signature"]; $search =$_POST["search"];
	    
		$now = new DateTime();
		//$now->format('Y-m-d H:i:s');    
		$now->setTimezone(new DateTimeZone('Europe/Stockholm'));
		$date = $now->getTimestamp(); 
		
        /*
	      $query = "INSERT INTO post(title,text,signature)
          VALUES ('$title','$text','$signature')";

     	if($_POST["title"] !== "Fyll i....." && $_POST["textarea"] !== "Fyll i....." && $_POST["signature"] !== "Fyll i....." && isset($_POST["submitbtn"]))
     	{
	    	$result = mysql_query($query)
	    	or die("Query failed");	

	    	if(!mysql_errno())
    		print "Posten är inlagd!";
     	}*/
     
     	
     	if(isset($_POST["searchbtn"]))
     	{
     		$query ="SELECT * FROM post WHERE title LIKE '%$search%'";

     		$result = mysql_query($query)
	    	or die("Query failed");	

	    	while ($line = mysql_fetch_object($result))
	    	{
	    		$title = $line->title;
	    		$returnstring = $returnstring . $title;
	    	}
	    	print utf8_encode($returnstring);	
     	}
     	//antalet bilder som ska läggas till printas ut...
     	if(isset($_POST["nrofpicbtn"]))
     	{
     		
     		$nr = $_POST["nrofpic"];


            //Spara antalet bilder som ska läggas in till nästa formulär
            $_SESSION['count'] = $nr;
     		//print "<test>Nummer:$nr </test>";

     		for($i=1;$i<=$nr;$i++)
     		{
     			$resultstring = $resultstring . "<image>";	
     			$resultstring = $resultstring . "<src>" . "src$i" . "</src>";
     			$resultstring = $resultstring . "<imagetext>" . "text$i" . "</imagetext>";	
     			$resultstring = $resultstring . "</image>";
     		}
     		print utf8_encode($resultstring);
     		
     	}


        //När man nu vill mata in hela inlägget med eller utan bilder..
        if(isset($_POST["submitbtn"]))
        {
            //Hämtar sessionvärdena
            $nrb = $_SESSION['count'];

            $title = $_POST["title"]; $text= $_POST["textarea"]; $signature=$_POST["signature"];

            print "<test> Count: $nrb Source:" .  $_FILES["src1"]["name"] ."TmpSource:". $_FILES["src1"]["tmp_name"] .  "Txt:" . $_POST["text1"] . "Title: $title Textarea: $text Signature: $signature </test>";

            // Säkrar strängarna för att införa dessa i DB    
            $title = mysql_real_escape_string($title);
            $text = mysql_real_escape_string($text); 
            $signature = mysql_real_escape_string($signature);
                
            $query = "INSERT INTO post(title,text,signature)
                VALUES ('$title','$text','$signature')";

            //Kollar så inga post variabler är tomma...        
            if($title !== "Fyll i....." && $text!== "Fyll i....." && $signature!== "Fyll i.....")   
            {
                $result = mysql_query($query)
                    or die("Query failed");

                    //Om man tryckt i att man vill ha 1 eller fler bilder samt fyllt i information
                    if($nrb!==0 && $source!=="Fyll i.....")
                    {
                        //Få ut rätt id för att lägga in bild(er)
                        $query = "SELECT MAX(id) AS ID FROM post";
                         $id = mysql_query($query)
                            or die("Query failed"); 

                         $id = mysql_fetch_array($id);
                         $id = $id['ID']; 
                         print "<test> ID: $id  src: " . $_FILES["src1"]["name"] . $_POST["text1"] . " </test>";    
                         
                        
                        for($i=1;$i<=$nrb;$i++)
                        {
                            $src = $_FILES["src".$i]["name"];
                            //$tmpsrc = $_FILES["src".$i]["tmp_name"];
                            $pictxt = $_POST["text".$i]; 

                            //Laddar upp bilden på servern...    
                             $allowedExts = array("gif", "jpeg", "jpg", "png");
                             $temp = explode(".", $_FILES["src".$i]["name"]);
                             $extension = end($temp);
                             if ((($_FILES["src".$i]["type"] == "image/gif")
                             || ($_FILES["src".$i]["type"] == "image/jpeg")
                             || ($_FILES["src".$i]["type"] == "image/jpg")
                             || ($_FILES["src".$i]["type"] == "image/pjpeg")
                             || ($_FILES["src".$i]["type"] == "image/x-png")
                             || ($_FILES["src".$i]["type"] == "image/png"))
                             && ($_FILES["src".$i]["size"] < 200000000)
                             && in_array($extension, $allowedExts))
                              {
                              if ($_FILES["src".$i]["error"] > 0)
                                {
                                echo "<test> Return Code: " . $_FILES["src".$i]["error"] . "</test>";
                                }
                              else
                                {
                                echo "<test> Upload: " . $_FILES["src".$i]["name"];
                                echo "Type: " . $_FILES["src".$i]["type"] . "<br>";
                                echo "Size: " . ($_FILES["src".$i]["size"] / 1024) . "kB";
                                echo "Temp file: " . $_FILES["src".$i]["tmp_name"] . "</test>";

                                if (file_exists("pictures/" . $_FILES["src".$i]["name"]))
                                  {
                                  echo "<test>" . $_FILES["src".$i]["name"] . " already exists. </test> ";
                                  }
                                else
                                  {
                                  move_uploaded_file($_FILES["src".$i]["tmp_name"],
                                  "pictures/" . $_FILES["src".$i]["name"]);
                                  echo "<test> Stored in: " . "pictures/" . $_FILES["src".$i]["name"] . "</test>";
                                  }
                                }
                              }
                            else
                              {
                              echo "<test>Invalid file </test>";
                              }
                              // Säkra strängarna...
                              $src = "pictures/" . $src; 
                              $src = mysql_real_escape_string($src);
                              $pictxt = mysql_real_escape_string($pictxt);

                            // Lägger en url till bilden på databasen
                            $query = "INSERT INTO image (id,path,pictext)
                                VALUES ('$id','$src','$pictxt')";

                            $result = mysql_query($query)
                                 or die("Query failed"); 
    
                        } 
                                     
                    }

                    if(!mysql_errno())
                            print "<test> Posten är inlagd! </test>";
                          
            }
            else
            {
                print "<test> Du har missat att fylla i någon ruta..</test>";
            } 

        }    
?>



<date> <?php print date('Y-m-d H:m:s',$date) ?> </date>

</post>
</blog>



<?php
if(!($debug)){
	include("postfix1.php");
} ?>