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

				<div id="adminpage" style="height: 120%;">
					<!-- Fill in how many pics u want to add -->	
					<div id="createpost" style="float:left; width:50%;height:100%;">
						<h2 style="text-align:center"> Skapa nytt inlägg </h2>
						<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;">
						<select name ="nrofpic">
					        <option value ="0">0</option>
						    <option value ="1">1</option>
						 	<option value ="2">2</option>
						 	<option value ="3">3</option>
						</select>
						<p><input type="submit" value="OK" name="nrofpicbtn"/></p>
						</form>	
						<!-- Fill in your blog post -->
						<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;" enctype="multipart/form-data">

							<xsl:for-each select="image">
							<p> <label for="file">Filnamn:</label>
								<input type="file" name="{src}" id="srcname"/> </p>
							<p>Bildtext:<textarea  rows="1" cols="50" id="picinfo" name="{imagetext}" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue">Fyll i.....</textarea> </p>
							</xsl:for-each>	
						
							<p>Fyll i titel:</p>
							<input type="text" name="title" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue"/>	

							<br></br>	
							<p>Skriv ditt inlägg:</p>
							<textarea rows="10" cols="30" id="myForm" name="textarea" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue">Fyll i.....</textarea>	

							<br></br>	
							<p>Din signatur:</p>
							<input type="text" name="signature" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue"/>	

							<br></br><br></br>
							<input type="checkbox" name="twitter" value="yes"/> Twittra även detta
							<p><input type="submit" value="Posta inlägg" name="submitbtn"/>	</p>


						</form>	

						<!-- Status/Error meddelande som visas då någon tjänst att utförts på hemsidan. -->
						<p style="text-align:center;color:green;"><xsl:apply-templates select="post/status"/> </p>
						<p style="text-align:center;color:red;"><xsl:apply-templates select="post/error"/> </p> 
					</div>	
					<!-- EDIT posts -->
					<div id="editpost" style="float:left;width:49%;height:100%;">
						<h2 style="text-align:center"> Redigera inlägg </h2>
						<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;">

							<input type="text" name="search" value="Fyll i....." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" />
							<input type="submit" value="Sök inlägg" name="searchbtn"/>

							<p style="text-align:center;color:blue;"><xsl:apply-templates select="test"/> </p>

						</form>

						<table border="1" style="margin:auto;">
							<tr>
								<th>Titel</th>
								<th>Signerad</th>
								<th>Postat</th>
							</tr>
							<xsl:for-each select="post">
							<tr>
								<td><a href="http://localhost:8888/TNM065/admin.php?title={title}&amp;dateid={date}"><xsl:value-of select="title"/></a></td>
								<td><xsl:value-of select="signature"/></td>
								<td><xsl:value-of select="date"/></td>
							</tr>
							</xsl:for-each>
						</table>

						<form action="admin.php" name="myForm" method="post" style="text-align:center; margin-top:3pc;">

							<p>Titel:</p>
							<input type="text" name="titleedit" value="{post/title}"/>

							<p>Redigera inlägg:</p>
							<textarea rows="10" cols="30" id="myForm" name="textareaedit" ><xsl:value-of select="post/text"/>.</textarea>

							<p>Din signatur:</p>
								<input type="text" name="signatureedit" value="{post/signature}"/>	

							<p><input type="submit" value="Utför ändringar" name="editbtn"/></p>
							<p><input type="submit" value="Ta bort detta inlägg" name="deletebtn"/></p>

						</form>

							<p style="text-align:center;color:green;"><xsl:apply-templates select="status"/> </p>
							<p style="text-align:center;color:red;"><xsl:apply-templates select="error"/> </p> 

					</div>	

					<div id="copyright" style="width:100%;">	
						<p style="text-align:center;bottom:0"><a href="logout.php">Log Out </a></p>	
						<p style="text-align:center"><xsl:value-of select="copyright"/></p>
					</div>
 
				</div>
				
				</body>
		   </html>
  </xsl:template>
  

</xsl:stylesheet>