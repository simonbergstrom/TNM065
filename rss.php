<?php header("Content-type:text/xml;charset=utf-8");?>
<rss version="2.0" >
<channel>

  <title>Bloggen</title>
  <link> http://localhost:8888/TNM065/rss.php </link> 
  <description> En blogg av Simon &amp; Max </description>
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
    $nr = "1";

     while ($line = mysql_fetch_object($result)) {
    $title = $line->title;
    $date = $line->date;
    $signature = $line->signature;
    $text = $line->text;
    $ID = $line->id;
      
      $returnstring = $returnstring . "<item>";
      $returnstring = $returnstring . "<title> $title $nr </title>";
      $returnstring = $returnstring . "<description> $text //$signature </description>";
      $returnstring = $returnstring . "<link> http://localhost:8888/TNM065/startpage.php </link>";
      $returnstring = $returnstring . "<pubDate>" . gmdate(DATE_RSS,strtotime($date)) . "</pubDate>";
      $returnstring = $returnstring . "</item>";

      $nr++;
    }

    print utf8_encode($returnstring); 

?>

</channel>
</rss>