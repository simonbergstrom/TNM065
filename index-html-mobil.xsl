<?xml version="1.0" encoding="UTF-8" standalone="no"?>



<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
   xmlns="http://www.w3.org/1999/xhtml">
   
    <xsl:template match="blog">

			<html>
				<head>
					<title> Simon &amp; Max's Blogg </title>
					<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
					<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
				</head>
				<body style="background-color:#FFFFCC;">
					
					<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-bottom:3px solid; color:orange;"  >
			   		   <div class="container" >

			      			<h1 style="text-align:center;" > Bloggen  </h1>
			    	  </div>

			 	   </div>
			 	  <div style="margin-top:3cm">
					 <xsl:apply-templates select="post" margin-top="1in"  /> 
					</div>
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
			<div  style="border-bottom:1px dotted;  margin-left:auto;  margin-right:auto;  text-align:center">		
			<p>  </p>
			</div>
			<xsl:text>&#xA;</xsl:text>
		</html>
	
	</xsl:template>

	<xsl:template match="image">

		<table>

		<div style="text-align:center;" >
		<p ><img src="{src}" style="text-align:center; height: auto; max-width: 100%"  /> </p>

		<p style="text-align:center"><xsl:value-of select="imagetext"/> </p>
	</div>
		</table>
	</xsl:template>		
	


</xsl:stylesheet>





