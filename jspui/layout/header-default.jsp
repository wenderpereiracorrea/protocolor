<%--

    The contents of this file are subject to the license and copyright
    detailed in the LICENSE and NOTICE files at the root of the source
    tree and available online at

    http://www.dspace.org/license/

--%>
<%--
  - HTML header for main home page
  --%>

<%@ taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>
<%@ taglib uri="http://www.dspace.org/dspace-tags.tld" prefix="dspace" %>

<%@ page contentType="text/html;charset=UTF-8" %>

<%@ page import="java.util.List"%>
<%@ page import="java.util.Enumeration"%>
<%@ page import="org.dspace.app.webui.util.JSPManager" %>
<%@ page import="org.dspace.core.ConfigurationManager" %>
<%@ page import="org.dspace.app.util.Util" %>
<%@ page import="javax.servlet.jsp.jstl.core.*" %>
<%@ page import="javax.servlet.jsp.jstl.fmt.*" %>

<%
    String title = (String) request.getAttribute("dspace.layout.title");
    String navbar = (String) request.getAttribute("dspace.layout.navbar");
    boolean locbar = ((Boolean) request.getAttribute("dspace.layout.locbar")).booleanValue();

    String siteName = ConfigurationManager.getProperty("dspace.name");
    String feedRef = (String)request.getAttribute("dspace.layout.feedref");
    boolean osLink = ConfigurationManager.getBooleanProperty("websvc.opensearch.autolink");
    String osCtx = ConfigurationManager.getProperty("websvc.opensearch.svccontext");
    String osName = ConfigurationManager.getProperty("websvc.opensearch.shortname");
    List parts = (List)request.getAttribute("dspace.layout.linkparts");
    String extraHeadData = (String)request.getAttribute("dspace.layout.head");
    String dsVersion = Util.getSourceVersion();
    String generator = dsVersion == null ? "DSpace" : "DSpace "+dsVersion;
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title><%= siteName %>: <%= title %></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="Generator" content="<%= generator %>" />
        <link rel="stylesheet" href="<%= request.getContextPath() %>/styles.css" type="text/css" />
        <link rel="stylesheet" href="<%= request.getContextPath() %>/print.css" media="print" type="text/css" />
        <link rel="shortcut icon" href="<%= request.getContextPath() %>/favicon.ico" type="image/x-icon"/>
		
		<%-- DSpace HEADER WENDER --%>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="assets/ico/favicon.png">
		
		<div class="navbar navbar-inverse navbar-fixed-top">
		<%-- DSpace HEADER WENDER --%>
		<link href="<%= request.getContextPath() %>/barra.css" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/css/docs.css" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css" />
		<link href="<%= request.getContextPath() %>/bootstrap/js/bootstrap.min.js" rel="stylesheet" type="text/css" />
		<%-- DSpace HEADER WENDER --%>
		
		<div id="barra-brasil">
		  <div class="barra">
			<ul>
			  <li>
			  <a href="http://www.acessoainformacao.gov.br" class="ai" title="Acesso à informação">www.sic.gov.br</a></li>
			  <li><a href="http://www.brasil.gov.br" class="brasilgov" title="Portal de Estado do Brasil">www.brasil.gov.br</a></li>
			</ul>
		  </div>
		  </div>
<%
    if (!"NONE".equals(feedRef))
    {
        for (int i = 0; i < parts.size(); i+= 3)
        {
%>
        <link rel="alternate" type="application/<%= (String)parts.get(i) %>" title="<%= (String)parts.get(i+1) %>" href="<%= request.getContextPath() %>/feed/<%= (String)parts.get(i+2) %>/<%= feedRef %>"/>
<%
        }
    }
    
    if (osLink)
    {
%>
        <link rel="search" type="application/opensearchdescription+xml" href="<%= request.getContextPath() %>/<%= osCtx %>description.xml" title="<%= osName %>"/>
<%
    }

    if (extraHeadData != null)
        { %>
<%= extraHeadData %>
<%
        }
%>
        
    <script type="text/javascript" src="<%= request.getContextPath() %>/utils.js"></script>
    <script type="text/javascript" src="<%= request.getContextPath() %>/static/js/scriptaculous/prototype.js"> </script>
    <script type="text/javascript" src="<%= request.getContextPath() %>/static/js/scriptaculous/effects.js"> </script>
    <script type="text/javascript" src="<%= request.getContextPath() %>/static/js/scriptaculous/builder.js"> </script>
    <script type="text/javascript" src="<%= request.getContextPath() %>/static/js/scriptaculous/controls.js"> </script>
    <script type="text/javascript" src="<%= request.getContextPath() %>/static/js/choice-support.js"> </script>
    </head>

    <%-- HACK: leftmargin, topmargin: for non-CSS compliant Microsoft IE browser --%>
    <%-- HACK: marginwidth, marginheight: for non-CSS compliant Netscape browser --%>
    <body>

        <%-- DSpace top-of-page banner --%>
        <%-- HACK: width, border, cellspacing, cellpadding: for non-CSS compliant Netscape, Mozilla browsers --%>

	<div height="276" border="0" leftmargin="0" rightmargin="0" topmargin="0" marginheight="0" marginwidth="0" cellspacing="0" cellpadding="0" align="left">

			<table class="pageBanner" width="100%" border="0" cellpadding="0" cellspacing="0">

            <%-- DSpace logo --%>
            <tr>
			<td class="tagLine">
			<a href="<%= request.getContextPath() %>/">
			<%-- DSpace HEADER WENDER --%>
			<img src="<%= request.getContextPath() %>/image/header2.jpg" alt="<fmt:message key="jsp.layout.header-default.alt"/>" width="100%" height="100%" border="0"/>
			</a>
			</td>
            </tr>
            <tr class="stripe"> <%-- Blue stripe --%>
                <td colspan="2">&nbsp;</td>
            </tr>
        </table>
      
		</table>
 </div>
       
        <%-- Localization --%>
<%--  <c:if test="${param.locale != null}">--%>
<%--   <fmt:setLocale value="${param.locale}" scope="session" /> --%>
<%-- </c:if> --%>
<%--        <fmt:setBundle basename="Messages" scope="session"/> --%>

        <%-- Page contents --%>

        <%-- HACK: width, border, cellspacing, cellpadding: for non-CSS compliant Netscape, Mozilla browsers --%>
        <table class="centralPane" width="99%" border="0" cellpadding="3" cellspacing="1">

            <%-- HACK: valign: for non-CSS compliant Netscape browser --%>
            <tr valign="top">

            <%-- Navigation bar --%>
<%
    if (!navbar.equals("off"))
    {
%>
            <td class="navigationBar">
                <dspace:include page="<%= navbar %>" />
            </td>
<%
    }
%>
            <%-- Page Content --%>

            <%-- HACK: width specified here for non-CSS compliant Netscape 4.x --%>
            <%-- HACK: Width shouldn't really be 100%, but omitting this means --%>
            <%--       navigation bar gets far too wide on certain pages --%>
            <td class="pageContents" width="100%">

                <%-- Location bar --%>
<%
    if (locbar)
    {
%>
                <dspace:include page="/layout/location-bar.jsp" />
<%
    }
%>
