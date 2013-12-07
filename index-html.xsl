<?xml version="1.0" encoding="UTF-8" standalone="no"?>

<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
   xmlns="http://www.w3.org/1999/xhtml">
   
    <xsl:template match="blog">

			<html>
				<head>
					<title> Simon &amp; Max's Blogg </title>
				</head>
				<body style="background-color:#FFFFCC;">
					<h1 style="text-align:center;"> Bloggen </h1>
					<form action="startpage.php" name="myFormlogin" method="post" style="text-align:right;">
					Användarnamn: <input type="text" name="username" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	
					Lösenord: <input type="password" name="password" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	<br></br>
					<input type="submit" value="Logga in" name="loginbtn"/>
					</form>	
					<xsl:apply-templates select="post" /> 	
				</body>
		   </html>
		
  </xsl:template>
  
  
  
  	<xsl:template match="post">
		<html>
	
			
			<h3 style="text-align:center"><xsl:value-of select= "title"/> </h3>
			<p style="text-align:center;margin-left:30%;margin-right:30%;"><xsl:apply-templates select="text"/></p>
			<xsl:apply-templates select="image"/>
			<p style="text-align:center"><xsl:apply-templates select="signature"/> <xsl:text> </xsl:text> 
			<xsl:apply-templates select="date"/></p>  			
			<p style="text-align:center"> -------------------------------------------------------------------------------------------------------------------------------------------- </p>
		</html>
	
	</xsl:template>

	<xsl:template match="image">

		<p style="text-align:center"><img src="{src}" height="400" weight="600"/> </p>
		<p style="text-align:center"><xsl:value-of select="imagetext"/> </p>

	</xsl:template>		
	


</xsl:stylesheet>


