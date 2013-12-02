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
		<html>

			<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;">
			
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

			 <p style="text-align:center"><xsl:value-of select="date"/></p>
			 
		</html>
	
	</xsl:template>
	


</xsl:stylesheet>