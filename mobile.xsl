<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:rss="http://purl.org/rss/1.0/"
                xmlns:dc="http://purl.org/dc/elements/1.1/"
                xmlns:syn="http://purl.org/rss/1.0/modules/syndication/"
                xmlns="http://www.w3.org/1999/xhtml"
                version="1.0">
<xsl:output indent="yes"/>
<xsl:template match="rdf:RDF">
   <html>
     <head>
       <title>Style Mobile</title>
     </head>

     <body style="background-color:#FFFFCC;">
    <xsl:apply-templates select = "rss:channel"/>

       <!-- <xsl:apply-templates /> -->
     </body>
   </html>
</xsl:template>

  <xsl:template match="rss:channel" >
      
        <!--<a href="{rss:link}"><h2><xsl:value-of select="rss:title"/></h2></a>-->
        <h1 style="text-align:center"><xsl:value-of select="rss:title"/></h1>
        <xsl:apply-templates select = "rss:item"/>
        
      
      
  </xsl:template> 

  <xsl:template match="rss:item" >
  <h2 style="text-align:center">  <xsl:value-of select="rss:title"/></h2>
  <p style="text-align:center"> <xsl:apply-templates select = "rss:description"/> </p> 
  <p style="text-align:center"> <xsl:apply-templates select = "rss:pubDate"/> </p>  
  <xsl:apply-templates select = "rss:image"/>
  <p style="text-align:center"> -------------------------------------------------------------------------------------------------------------------------------------------- </p>
  </xsl:template> 

  <xsl:template match="rss:image" >
  <p style="text-align:center"> <xsl:value-of select="rss:title"/></p>
  <p style="text-align:center"><xsl:value-of select="description"/> </p>

  </xsl:template> 



</xsl:stylesheet>
