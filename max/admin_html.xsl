<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
   xmlns="http://www.w3.org/1999/xhtml">
   
    <xsl:template match="blog">
			<html>
				<head>
					<title> Simon &amp; Max Blogg </title>
				</head>
				<body style="background-color:#FFFFCC;">
					<h1 style="text-align:center;"> Bloggen </h1>
					<h3 style="text-align:center;"> ADMIN </h3>		
					
					<xsl:apply-templates select="post" /> 	
				
				</body>
		   </html>
  </xsl:template>
  
  
  
  	<xsl:template match="post">

			
			<form name="bilder" method="post" style="text-align:center; margin-top:3pc;">
			<select name ="pic">
		        <option value ="1">1</option>
			    <option value ="2">2</option>
			 	<option value ="3">3</option>
			    <option value ="4">4</option>
			    <option value ="5">5</option>
			</select>
			<p><input type="submit" value="OK" name="bild"/>	</p>
			<xsl:apply-templates select = "test"/>
			<xsl:apply-templates select="image" />
			</form>	

			<form action="" name="myForm" method="post" style="text-align:center; margin-top:3pc;">
			
			<p><xsl:value-of select="title"/></p>
			<input type="text" name="title" value="Fyll i....."/>	

			<br></br>	
			<p><xsl:value-of select="text"/></p>
			<textarea rows="10" cols="30" id="myForm" name="textarea" >Fyll i.....</textarea>	

			<br></br>	
			<p><xsl:value-of select="signature"/></p>
			<input type="text" name="signature" value="Fyll i....."/>	

			<br></br>	


			
			<p><input type="submit" value="Posta inlägg" name="submitbtn"/>	</p>
			
			</form>	
		

	
	</xsl:template>


    <xsl:template match="image">

    	<form action="" name="bilder" method="post" style="text-align:center; margin-top:3pc;">
    	<p><textarea  rows="1" cols="50" id="myForm" name="{src}" >src...</textarea> </p>
    	<p><textarea  rows="1" cols="50" id="myForm" name="{imagetext}" >bild text...</textarea> </p>
 		
    	
    	 <xsl:apply-templates/>
    	 <p><input type="submit" value="Update" name="submitbild"/>	</p>


 		</form>

	</xsl:template>

	<xsl:template match="test">
		
		<xsl:apply-templates/>

	</xsl:template>

</xsl:stylesheet>