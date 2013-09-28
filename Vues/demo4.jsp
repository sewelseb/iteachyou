<!--

BigBlueButton - http://www.bigbluebutton.org

Copyright (c) 2008-2009 by respective authors (see below). All rights reserved.

BigBlueButton is free software; you can redistribute it and/or modify it under the 
terms of the GNU Lesser General Public License as published by the Free Software 
Foundation; either version 3 of the License, or (at your option) any later 
version. 

BigBlueButton is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along 
with BigBlueButton; if not, see <http://www.gnu.org/licenses/>.

Author: Islam El-Ashi <ielashi@gmail.com>

-->

<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<% 
	request.setCharacterEncoding("UTF-8"); 
	response.setCharacterEncoding("UTF-8"); 
%>

<%@page import="org.w3c.dom.*"%>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ITeachYou TABLES</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Open+Sans+Condensed:300,700" rel="stylesheet" />
<link href="css/Justifiable CSS/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/Justifiable CSS/fonts.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/demo4/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/demo4.js"></script>
<script type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/jquery.xml2json.js"></script>
<style type="text/css">
.hiddenDiv {display:none;}
.hor-minimalist-b{font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:12px;background:#fff;width:480px;border-collapse:collapse;text-align:left;margin:20px;}.hor-minimalist-b th{font-size:14px;font-weight:normal;color:#039;border-bottom:2px solid #6678b1;padding:10px 8px;}.hor-minimalist-b td{border-bottom:1px solid #ccc;color:#669;padding:6px 8px;width:100px;}.hor-minimalist-b tbody tr:hover td{color:#009;}</style>
</head>
<body>

<%@ include file="bbb_api.jsp"%>

<%
if (request.getParameterMap().isEmpty()) {
%>


<div id="logo" class="container">
	<h1><span class="icon icon-comments-alt icon-size"></span><a href="index.html">I<span>teach</span>You</a></h1>
	
	<p>Version Beta // Work in progress</p>
</div>
<div id="wrapper" class="container">
	<!-- MENU-->
	<div id="menu" class="container">
		<ul>
			<li><a href="index.html#description_iteachyou" accesskey="1" title="">IteachYou</a></li>
			<li><a href="index.html#pourquoi_valeurs" accesskey="2" title="">FAQ</a></li>
			<li><a href="index.html#nous" accesskey="3" title="">L'équipe</a></li>
			<li><a href="index.html#contact" accesskey="4" title="">Contact</a></li>
		</ul>
	</div>

	<!-- Création de table -->
	<div id="portfolio2">
		<div id="accueil">
			<span class="arrow-down"></span>
		</div>
		<div class="title">
			<h2>La salle de <span>classe</span></h2>
			<p>Ici, vous pouvez créer une nouvelle salle de classe.</p>
			<a href="create.jsp" class="button">Créez votre salle</a>
			<p>Si vous préférez, vous pouvez rejoindre une salle déjà active ci-dessous.</p>
		</div>
	</div>
	<!-- Liste des tables -->
	<div id="three-column">
		<div id="accueil">
			<span class="arrow-down"></span>
		</div>
		<div class="title">
			<p></p>
			<h1>Salles actives</h1>		
		
			<!-- ca je sais pas à quoi ça sert... --><p id="no_meetings"></p> 
		<div id="meetings"></div>
	</div>
<% } 
else if (request.getParameter("action").equals("end")) {

String mp = request.getParameter("moderatorPW");
String meetingID = request.getParameter("meetingID");

String result = endMeeting(meetingID, mp);

if ( result.equals("true") ){
%>

	<div class="title">
		<h2>Tables <span>Actives</span></h2>
	</div>

<%=meetingID%> has been terminated.

	<p id="no_meetings"></p>

	<div id="meetings"></div>

<%} 
else { %>

	<div class="title">
		<h2>Tables <span>Actives</span></h2>
	</div>

Unable to end meeting: <%=meetingID%>
<%=result%>
<%}
}%>
	
</div>
</div>


<div id="copyright">
	<p>Copyright (c) 2013 Sitename.com. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>
</body>
</html>

 

