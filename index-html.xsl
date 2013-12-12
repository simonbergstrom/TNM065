<?xml version="1.0" encoding="UTF-8" standalone="no"?>

<xsl:stylesheet version="1.0"
   xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
   xmlns="http://www.w3.org/1999/xhtml">
   
    <xsl:template match="blog">

			<html>
				<head>
					<title> Simon &amp; Max's Blogg </title>
					<link rel="stylesheet" type="text/css" href="bootstrap.css"/>

				</head>
				<body style="background-color:#FFFFCC;">
					<!--<h1 style="text-align:center;"> Bloggen </h1>-->

					<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-bottom:3px solid; color:green;"  >
			   		   <div class="container" >
			   		   		<div class="navbar-header">
			    
        					  <h2 >Bloggen  </h2>
        					  <a style="color:green; text-align:center;"  href="mobil.php"> Bloggen i RSS <img src="pictures/rss.png" height="20" weight="40"/></a>

			      			</div>

			      			<div class="navbar-collapse collapse">
			  

					      	<form action="startpage.php" name="myFormlogin" method="post" class="navbar-form navbar-right" role="form">
							 	<div class="form-group">
							 		<input type="text" placeholder="username " class="form-control" name="username" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />
				             		
				          		</div>
				           		<div class="form-group">
				           			<input type="password" placeholder="password" class="form-control" name="password" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />

				             		<!-- <input type="password" placeholder="Password" class="form-control"> -->
				       		    </div>


							<!--Användarnamn: <input type="text" name="username" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	

							Lösenord: <input type="password" name="password" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" /> -->
							<button type="submit" class="btn btn-success" name="loginbtn" value="Logga in" >Sign in</button>
							<!--<input type="submit" value="Logga in" name="loginbtn"/>-->


							</form>	
							</div>

			    	  </div>

			 	   </div>





			 		 <div style="margin-top:3cm">
						 <xsl:apply-templates select="post" /> 
					</div>

<!--
					<form action="startpage.php" name="myFormlogin" method="post" style="text-align:right;">
					Användarnamn: <input type="text" name="username" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	
					Lösenord: <input type="password" name="password" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />	<br></br>
					<input type="submit" value="Logga in" name="loginbtn"/>
					</form>	
				-->
				
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

		<table>
		<p style="text-align:center"><img src="{src}" height="400" weight="600"/> </p>

		<p style="text-align:center"><xsl:value-of select="imagetext"/> </p>
		</table>
	</xsl:template>		
	


</xsl:stylesheet>


