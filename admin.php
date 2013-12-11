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
	    

     	// Om man söker efter inlägg.. inte klart än
     	if(isset($_POST["searchbtn"]))
     	{
     		$query ="SELECT * FROM post WHERE title LIKE '%$search%'";

     		$result = mysql_query($query)
	    	or die("Query failed");	

            $resultstring="";
            //Visa resultat av sökningen... visar titel,signatur och datum..
            
	    	while ($line = mysql_fetch_object($result))
	    	{
                $returnstring = $returnstring . "<post>";
	    		$title = $line->title;
                $date = $line->date;
                $signature = $line->signature;

	    		$returnstring = $returnstring ."<title>" .  $title . "</title>";
                $returnstring = $returnstring ."<signature>" .  $signature . "</signature>";
                $returnstring = $returnstring ."<date>" . $date . "</date>";
                $returnstring = $returnstring . "</post>";
	    	}
                
	    	print utf8_encode($returnstring);	
     	}




        if(isset($_GET["title"]) && isset($_GET["dateid"]))
        {
            $test = $_GET["title"];
            $dateid = $_GET["dateid"];

            $query ="SELECT title,text,signature,date,image.path FROM post JOIN image ON post.id=image.id WHERE post.date LIKE '$dateid'";
            print utf8_encode("<test> SASSE: $test DATEID: $dateid </test>");

            $result = mysql_query($query)
            or die("Query failed"); 

            //Sparar path till alla bilder
            $pathtemp=array();
            $count=0;
            $returnstring="";

            //Hämtar info som ev. ska redigeras
            //Borde bara visa ett inlägg!!

            $line = mysql_fetch_object($result);
            $titletemp = $line->title;
            $texttemp = $line->text;
            $signaturetemp = $line->signature;
            $datetemp = $line->date;
            array_push($pathtemp,$line->path);

            $resultstring="<post><title>" . $titletemp . "</title>";
            $resultstring= $resultstring ."<text>" . $texttemp . "</text>"; 
            $resultstring= $resultstring ."<signature>" . $signaturetemp . "</signature>";
            $resultstring= $resultstring ."<date>" . $datetemp . "</date>";
            //$resultstring= $resultstring ."<image>" . "<src>" $datetemp . "</src>";

            //OM mer än 1 bild..
            while($line = mysql_fetch_object($result))
            {
                array_push($pathtemp,$line->path);
                $count=$count+1;
                //$resultstring= $resultstring . "<src>" $datetemp . "</src>";
            } 

            $resultstring= $resultstring ."</post>";
            //$edittitle;   
            //$query = "UPDATE post SET title =  'HEY update!' WHERE DATE =  '2013-12-11 13:10:48"

            print utf8_encode($resultstring);

        }    

     	//antalet bilder som ska läggas till printas ut...
     	if(isset($_POST["nrofpicbtn"]))
     	{
     		$resultstring="";
     		$nr = $_POST["nrofpic"];


            //Spara antalet bilder som ska läggas in till nästa formulär
            $_SESSION['count'] = $nr;

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

            echo "<post>";

            $title = $_POST["title"]; $text= $_POST["textarea"]; $signature=$_POST["signature"];

            //print "<test> Count: $nrb Source:" .  $_FILES["src1"]["name"] ."TmpSource:". $_FILES["src1"]["tmp_name"] .  "Txt:" . $_POST["text1"] . "Title: $title Textarea: $text Signature: $signature </test>";

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
                    //print "<test> ID: $id  src: " . $_FILES["src1"]["name"] . "bildtext: " . $_POST["text1"] . " </test>";    
                     
                    
                    for($i=1;$i<=$nrb;$i++)
                    {
                        //Info som ska läggas i databasen....
                        $src = $_FILES["src".$i]["name"];
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
                                echo "<error> Return Code: " . $_FILES["src".$i]["error"] . "</error>";
                                $error=1; 
                            }
                          else
                            {
                                if (file_exists("pictures/" . $_FILES["src".$i]["name"]))
                                  {
                                    // Filen finns på servern redan... men kommer ändå att länkas till skapat blogg inlägg
                                    //echo "<test>" . $_FILES["src".$i]["name"] . " already exists. </test> ";
                                  }
                                else
                                  {
                                  move_uploaded_file($_FILES["src".$i]["tmp_name"],
                                  "pictures/" . $_FILES["src".$i]["name"]);
                                  //echo "<test> Stored in: " . "pictures/" . $_FILES["src".$i]["name"] . "</test>";
                                  }
                                    
                                    // Säkra strängarna...
                                  $src = "pictures/" . $src; 
                                  $src = mysql_real_escape_string($src);
                                  $pictxt = mysql_real_escape_string($pictxt);

                                // Lägger en url till bilden på databasen
                                $query = "INSERT INTO image (id,path,pictext)
                                    VALUES ('$id','$src','$pictxt')";

                                $result = mysql_query($query)
                                     or die("<error>Query failed</error>");

                                 $error=0;     
                            }
                          }
                        else
                          {
                            echo "<error>Invalid file </error>";
                            $error=1;
                          }


                    } 
                                 
                }

                if(!mysql_errno() && $error!==1) 
                {
                    print "<status> Posten är inlagd! </status>"; 
                }
            }

            else
            {
              print "<error> Du har missat att fylla i någon ruta..</error>";
            }
            echo "</post>"; 
        }


?>
<copyright> <?php print date('Y-m-d H:m:s') ?> </copyright>

</blog>

<?php
if(!($debug))
{ include("postfix1.php"); } ?>