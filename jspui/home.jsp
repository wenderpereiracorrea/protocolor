<%--
  - home.jsp
  -
  - Version: $Revision: 3705 $
  -
  - Date: $Date: 2009-04-11 17:02:24 +0000 (Sat, 11 Apr 2009) $
  -
  - Copyright (c) 2002, Hewlett-Packard Company and Massachusetts
  - Institute of Technology.  All rights reserved.
  -
  - Redistribution and use in source and binary forms, with or without
  - modification, are permitted provided that the following conditions are
  - met:
  -
  - - Redistributions of source code must retain the above copyright
  - notice, this list of conditions and the following disclaimer.
  -
  - - Redistributions in binary form must reproduce the above copyright
  - notice, this list of conditions and the following disclaimer in the
  - documentation and/or other materials provided with the distribution.
  -
  - - Neither the name of the Hewlett-Packard Company nor the name of the
  - Massachusetts Institute of Technology nor the names of their
  - contributors may be used to endorse or promote products derived from
  - this software without specific prior written permission.
  -
  - THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
  - ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
  - LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
  - A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
  - HOLDERS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
  - INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
  - BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
  - OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
  - ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
  - TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
  - USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
  - DAMAGE.
  --%>

<%--
  - Home page JSP
  -
  - Attributes:
  -    communities - Community[] all communities in DSpace
  --%>

<%@ page contentType="text/html;charset=UTF-8" %>

<%@ taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>

<%@ taglib uri="http://www.dspace.org/dspace-tags.tld" prefix="dspace" %>

<%@ page import="java.io.File" %>
<%@ page import="java.util.Enumeration"%>
<%@ page import="java.util.Locale"%>
<%@ page import="javax.servlet.jsp.jstl.core.*" %>
<%@ page import="javax.servlet.jsp.jstl.fmt.LocaleSupport" %>
<%@ page import="org.dspace.core.I18nUtil" %>
<%@ page import="org.dspace.app.webui.util.UIUtil" %>
<%@ page import="org.dspace.content.Community" %>
<%@ page import="org.dspace.core.ConfigurationManager" %>
<%@ page import="org.dspace.browse.ItemCounter" %>

<%
    Community[] communities = (Community[]) request.getAttribute("communities");

    Locale[] supportedLocales = I18nUtil.getSupportedLocales();
    Locale sessionLocale = UIUtil.getSessionLocale(request);
    Config.set(request.getSession(), Config.FMT_LOCALE, sessionLocale);
    String topNews = ConfigurationManager.readNewsFile(LocaleSupport.getLocalizedMessage(pageContext, "news-top.html"));
    String sideNews = ConfigurationManager.readNewsFile(LocaleSupport.getLocalizedMessage(pageContext, "news-side.html"));

    boolean feedEnabled = ConfigurationManager.getBooleanProperty("webui.feed.enable");
    String feedData = "NONE";
    if (feedEnabled)
    {
        feedData = "ALL:" + ConfigurationManager.getProperty("webui.feed.formats");
    }
    
    ItemCounter ic = new ItemCounter(UIUtil.obtainContext(request));
%>

<dspace:layout locbar="nolink" titlekey="jsp.home.title" feedData="<%= feedData %>">

    <table  width="85%" align="center">
      <tr align="right">
        <td align="right">						
<% if (supportedLocales != null && supportedLocales.length > 1)
{
%>
        <form method="get" name="repost" action="">
          <input type ="hidden" name ="locale"/>
        </form>
<%
for (int i = supportedLocales.length-1; i >= 0; i--)
{
%>
        <a class ="langChangeOn"
                  onclick="javascript:document.repost.locale.value='<%=supportedLocales[i].toString()%>';
                  document.repost.submit();">
                 <%= supportedLocales[i].getDisplayLanguage(supportedLocales[i])%>
        </a> &nbsp;
<%
}
}
%>
        </td>
      </tr>
      <tr>
            <td class="oddRowEvenCol"><%= topNews %></td>
        </tr>
    </table>
    <br/>
    <div align="justify"> Bem-vindo à Biblioteca Digital da Fundação Casa de Rui Barbosa. 

Nosso meta é possibilitar, de forma integrada, a gestão e divulgação de documentos em meio digital. 

Você encontrará aqui dois tipos de material: a produção técnico-científica da instituição e o acervo documental adquirido pela FCRB através de doação, compra ou intercâmbio. </div>
    <form action="<%= request.getContextPath() %>/simple-search" method="get">
        <table class="miscTable" width="85%" align="center">
            <tr>
                <td class="oddRowEvenCol">
                 <h3><fmt:message key="jsp.home.search1"/>
                  <a href="<%= request.getContextPath() %>/advanced-search"><fmt:message key="jsp.layout.navbar-default.advanced"/></a>
<%
                        if (ConfigurationManager.getBooleanProperty("webui.controlledvocabulary.enable"))
                        {
%>
              <br/><a href="<%= request.getContextPath() %>/subject-search"><fmt:message key="jsp.layout.navbar-default.subjectsearch"/></a>
<%
            }
%>
</h3>
                   <p><label for="tquery"><fmt:message key="jsp.home.search2"/></label></p>
                      <p><input type="text" name="query" size="20" id="tquery" />&nbsp;
                         <input type="submit" name="submit" value="<fmt:message key="jsp.general.search.button"/>" /></p>

              </td>
                   
            </tr>
        </table>
    </form>
    <table class="miscTable" width="85%" align="center">
        <tr>
            <td class="oddRowEvenCol">
               
               <h3><fmt:message key="jsp.home.com1"/></h3>
                <p><fmt:message key="jsp.home.com2"/></p>


<%
 if (communities.length != 0)
 {
%>
    <table border="0" cellpadding="2">
<% 	                 

    for (int i = 0; i < communities.length; i++)
    {
%>                  <tr>
                        <td class="standard">
       <div> <a href="<%= request.getContextPath() %>/handle/<%= communities[i].getHandle() %>"><%= communities[i].getMetadata("name") %></a>
<div>
<img src="<%= request.getContextPath() %>/image/prodteccient.jpg" width="211" height="123" border="0">
</div>
                            <a href="<%= request.getContextPath() %>/handle/<%= communities[i].getHandle() %>"><%= communities[i].getMetadata("name") %></a>
</div>

<%
        if (ConfigurationManager.getBooleanProperty("webui.strengths.show"))
        {
%>
            [<%= ic.getCount(communities[i]) %>]
<%
        }

%>
                        </td>
                  
                    </tr>
<%
    }
%>
    </table>
<%                
 }
%>  

            </td>
        </tr>
    </table>
    <dspace:sidebar>
    <%= sideNews %><br>
<div>Veja também:</div>
<div> 
</div>

<div align="center">
<form method="get" action="http://scholar.google.com/scholar">
<table bgcolor="#FFFFFF">
  <tr>
    <td align="center"><a href="http://scholar.google.com/"> <img src="http://scholar.google.com/scholar/scholar_sm.gif" alt="Google Scholar" width="100" height="35" border="0" align="absmiddle" /></a><br />
    <input type="hidden" name="hl" value="en">
    <input type="text" name="q" size="10" maxlength="255" value="" /><br />
    <input type="submit" name="btnG" size="7" value="Search" />
    </td>
  </tr>
</table>
</form></div>   <br>

 <%
    if(feedEnabled)
    {
	%>
	    <center>
	   <%-- <h4><fmt:message key="jsp.home.feeds"/></h4> --%>
	<%
	    	String[] fmts = feedData.substring(feedData.indexOf(':')+1).split(",");
	    	String icon = null;
	    	int width = 0;
	    	for (int j = 0; j < fmts.length; j++)
	    	{
	    		if ("rss_1.0".equals(fmts[j]))
	    		{
	    		   icon = "rss1.gif";
	    		   width = 80;
	    		}
	    		else if ("rss_2.0".equals(fmts[j]))
	    		{
	    		   icon = "rss2.gif";
	    		   width = 80;
	    		}
	    		else
	    	    {
	    	       icon = "rss.gif";
	    	       width = 36;
	    	    }
	%>
	    <a href="<%= request.getContextPath() %>/feed/<%= fmts[j] %>/site"><img src="<%= request.getContextPath() %>/image/<%= icon %>" alt="RSS Feed" width="<%= width %>" height="15" vspace="3" border="0" /></a>
	<%
	    	}
	%>
	    </center>
	<%
	    }
	%>



    </dspace:sidebar>
</dspace:layout>
