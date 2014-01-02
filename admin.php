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

		$title = $_POST["title"]; $text= $_POST["textarea"]; $signature=$_POST["signature"]; 
    $search =$_POST["search"];
	    

     	// Om man söker efter inlägg för att senare kunna redigera
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
      //IF edit of post btn is pressed 
        if (isset($_POST["editbtn"]))
        {
            $title = $_POST["titleedit"];
            $text  = $_POST["textareaedit"];  
            $signature = $_POST["signatureedit"];
            $date = $_SESSION["date"];


            $query = "UPDATE post SET title='$title',text='$text',signature='$signature' WHERE date='$date'";
            
            $result = mysql_query($query)
                or die("Query failed");

                if(!mysql_errno() && isset($_POST["titleedit"]) && $text!=="." && isset($_POST["signatureedit"]))
                    print "<status> Inlägget ändrades! </status>";
                else
                    print "<error> Du har inte laddat in något inlägg </error>";

        }

        //if delete btn is pressed
        if (isset($_POST["deletebtn"]))
        {

            $date = $_SESSION["date"];

            // First get the id for deleting pics and texts...
            $query = "SELECT id FROM `project`.`post` WHERE `post`.`date` = '$date'";

            $result = mysql_query($query)
                or die("Query failed");

            $id = mysql_fetch_object($result);

            $id = $id->id;

            // Then delete all....

            //For the post
            $query = "DELETE FROM post WHERE id = '$id'";

            $result = mysql_query($query)
                or die("Query failed");


             //For the pictures
             $query = "DELETE FROM `project`.`image` WHERE `image`.`id` = '$id'"; 
             
             if(isset($query))
            {
                $result = mysql_query($query)
                or die("Query failed");
            }
            
            if(!mysql_errno())
                print "<status> Inlägget raderades! </status>";  
            else
                print "<error> Nått gick fel! Försök igen! </error>";


        }

        //Updates field with result of posts of edit
        if(isset($_GET["title"]) && isset($_GET["dateid"]))
        {
            $test = $_GET["title"];
            $dateid = $_GET["dateid"];

            $query ="SELECT title,text,signature,date,image.path,image.pictext FROM post JOIN image ON post.id=image.id WHERE post.date LIKE '$dateid'";

            $result = mysql_query($query)
            or die("Query failed"); 

            $count=0;
            $returnstring="";

            //Hämtar info som ev. ska redigeras
            //Borde bara visa ett inlägg!!

            $line = mysql_fetch_object($result);
            $titletemp = $line->title;
            $texttemp = $line->text;
            $signaturetemp = $line->signature;
            $datetemp = $line->date;
            $imgpath = $line->path;
            $imgtext = $line->pictext;


            $resultstring="<post><title>" . $titletemp . "</title>";
            $resultstring= $resultstring ."<text>" . $texttemp . "</text>"; 
            $resultstring= $resultstring ."<signature>" . $signaturetemp . "</signature>";
            $resultstring= $resultstring ."<date>" . $datetemp . "</date>";
            $resultstring= $resultstring ."<image>" . "<src>" . $imgpath . "</src>";
            $resultstring= $resultstring ."<imagetext>" . $imgtext . "</imagetext>";

            //OM mer än 1 bild..
            while($line = mysql_fetch_object($result))
            {
                
                $imgpath = $line->path;
                $imgtext = $line->pictext; 

                $resultstring= $resultstring . "<src>" . $imgpath . "</src>";
                $resultstring= $resultstring . "<imagetext>" . $imgtext . "</imagetext>";
            } 

            $resultstring= $resultstring ."</image></post>";

            //Behövs då vi ska uppdatera inlägget..Primary key
            $_SESSION["date"] = $datetemp;

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
                            // nått gick snett ... errorhanteringen längre ner
                            $_SESSION['count']= 0;
                            $error=1;
                          }
                    }                
                }

                if(!mysql_errno() && $error!==1) 
                {
                    print "<status> Posten är inlagd! </status>"; 
                    // OM twitter check box är itryckt..  
                    
                    if( isset($_POST['twitter']))
                    {
                        include 'twitter/twittertest.php';
                        sendtweet($text);
                    }
                    //Sätt till 0 då inlägg har postats..
                    $_SESSION['count']= 0;
                }
                else
                {
                   print "<error> Nått gick fel! Försök igen! </error>";
                   // Ta bort de redan skapade textinlägget om något annat blev fel... så får man göra ett nytt försök
                   $query = "DELETE FROM post WHERE title = '$title' AND text= '$text' AND signature='$signature'"; 
                   $result = mysql_query($query);
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