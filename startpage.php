<?php 
$debug=0;

if($debug){
	header("Content-type:text/xml;charset=utf-8");
}else {
	include("prefix.php");
}
	
?>
<!DOCTYPE blog SYSTEM "blog.dtd"[

	<!ENTITY aring "&#229;"> 
	<!ENTITY Aring "&#197;"> 
	<!ENTITY ouml "&#246;"> 
	<!ENTITY Ouml "&#214;">
	<!ENTITY auml "&#228;">
	<!ENTITY Auml "&#196;">

]>
 
<?php
    //Session f�r att logga in
    session_start();

    $link = mysql_connect("localhost", "root", "root")
        or die("Could not connect");
     
    mysql_select_db("project")
        or die("Could not select database");
    $returnstring ="";
 
    $query = "SELECT  id,date,signature,title,text
            FROM post ORDER BY date DESC";
     
    $result = mysql_query($query)
    or die("Query failed");
	
    // Kolla login uppgifter
    if(isset($_POST['loginbtn'])) {
    $username = ($_POST['username']);
    $password = ($_POST['password']);

    $login = mysql_query("SELECT * FROM user WHERE (username = '$username' AND password = '$password')")
	or die("Query faileD");
   // Check username and password match
    if (mysql_num_rows($login) == 1)
    {

        // Set username session variable
        $_SESSION['username'] = $_POST['username'];
        // Jump to secured page
        header('Location: admin.php');
    }
}
/*     else 
    {
    // Nothing 
        //SKriv ut n�tt felmeddelande... fixa entity f�r de sen..
    }
*/

	//$hej = array("�","�","�","�","�","�");
	//$dej = array("&aring;","&auml;","&ouml;","&Aring;","&Auml;","&Ouml;");
 
 
     $returnstring = "<blog>";
        while ($line = mysql_fetch_object($result)) {
             
            $ID = $line->id;
 
            $queryimage = "SELECT  path , image.id, post.id, pictext FROM image JOIN post WHERE image.id = post.id ORDER BY post.date DESC";
            $resultimage = mysql_query($queryimage);
 
            $date = $line->date;
            $signature = $line->signature;
            $title = $line->title;
            $text = $line->text;
             
             $returnstring = $returnstring . "<post>" ;
             $returnstring = $returnstring . "<title>" . $title .  "</title>";
             $returnstring = $returnstring . "<text>" . $text .  "</text>";
 
  
             while ($lineimage = mysql_fetch_object($resultimage)){
                $path = $lineimage->path;
                $pictext = $lineimage->pictext;
                $IDimage = $lineimage->id;
               
                if($ID == $IDimage){
 
                    $returnstring = $returnstring . '<image> <src>' . $path . '</src>';
                     $returnstring = $returnstring . "<imagetext>"  . $pictext . "</imagetext>";
                     $returnstring = $returnstring . "</image>";
                }
                 
             }
             
             $returnstring = $returnstring . "<signature>" . $signature .  "</signature>";
             $returnstring = $returnstring . "<date>" . $date .  "</date>";
             $returnstring = $returnstring . "</post>" ;
 
        }
     $returnstring =  $returnstring . "</blog>";
	 //$returnstring = str_replace($hej,$dej,$returnstring);
 
    print utf8_encode($returnstring);
  
?>

<?php
if(!($debug)){
	include("postfix.php");
}
