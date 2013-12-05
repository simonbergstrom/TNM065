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

					<p style="text-align:center;"><a href="logout.php">Log Out </a></p>	
				</body>
		   </html>
  </xsl:template>
  
  
  
  	<xsl:template match="post">
		<html>
			<div id="createpost">
				<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;">
				
					<p><xsl:value-of select="title"/></p>
					<input type="text" name="title" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	

					<br></br>	
					<p><xsl:value-of select="text"/></p>
					<textarea rows="10" cols="30" id="myForm" name="textarea" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" >Fyll i.....</textarea>	

					<br></br>	
					<p><xsl:value-of select="signature"/></p>
					<input type="text" name="signature" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	

					<br></br>	
					<p><input type="submit" value="Posta inlägg" name="submitbtn"/>	</p>

				</form>	
			</div>	

			<div id="editpost">
				
				<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;">

					<input type="text" name="search" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />
					<input type="submit" value="Sök inlägg" name="searchbtn"/>

				</form>		

				<xsl:apply-templates select="test"/> 	
				
			</div>	

			 <p style="text-align:center"><xsl:value-of select="date"/></p>

			 
		</html>
	
	</xsl:template>



</xsl:stylesheet>