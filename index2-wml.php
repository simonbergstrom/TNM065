<?php include 'prefix.php';?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:syn="http://purl.org/rss/1.0/modules/syndication/">

<channel>

  <title>Bloggen</title>
  <link>http://localhost/TNM065/proj/index2-wml.php</link>
  <description></description>
  <author> MH </author>


 <?php  

  $link = mysql_connect("localhost", "root", "root")
        or die("Could not connect");
     
    mysql_select_db("project")
        or die("Could not select database");
    
 
    $query = "SELECT  id,date,signature,title,text
            FROM post ORDER BY date DESC";
     
    $result = mysql_query($query)
    or die("Query failed");

    $returnstring = "";

     while ($line = mysql_fetch_object($result)) {
    $title = $line->title;
    $date = $line->date;
    $signature = $line->signature;
    $text = $line->text;
     $ID = $line->id;
 
            $queryimage = "SELECT  path , image.ID, post.ID, pictext FROM image JOIN post WHERE image.ID = post.ID ORDER BY post.date DESC";
            $resultimage = mysql_query($queryimage);

      
      $returnstring = $returnstring . "<item>";
      $returnstring = $returnstring . "<title> $title </title>";
      $returnstring = $returnstring . "<description> $text </description>";
      $returnstring = $returnstring . "<author>max.hjartstrom@gmail.com ($signature) </author>";
      $returnstring = $returnstring . "<pubDate> $date </pubDate>";
      $returnstring = $returnstring . "</item>";

        $returnstring = $returnstring . "<image>";

                while ($lineimage = mysql_fetch_object($resultimage)){
                  $path = $lineimage->path;
                  $pictext = $lineimage->pictext;
                  $IDimage = $lineimage->ID;
                 
                  if($ID == $IDimage){
   
                      $returnstring = $returnstring . " <url>$path</url>";
                      $returnstring = $returnstring . " <title>Bild</title> ";
                      $returnstring = $returnstring . "<link>http://localhost/TNM065/proj/index2-wml.php</link>";
                      $returnstring = $returnstring . "<description> $pictext </description>";
               
                  }
                   
               }
        $returnstring = $returnstring . "</image>";

    }

    print utf8_encode($returnstring); 

?>

</channel>

</rdf:RDF>
<?php include 'postfixrss.php';?>