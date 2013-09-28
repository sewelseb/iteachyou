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
with BigBlueButton; if not, If not, see <http://www.gnu.org/licenses/>.

Author: Fred Dixon <ffdixon@bigbluebutton.org>
  
-->

<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<% 
	request.setCharacterEncoding("UTF-8"); 
	response.setCharacterEncoding("UTF-8"); 
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>ITeachYou Rejoindre</title>

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/heartbeat.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Open+Sans+Condensed:300,700" rel="stylesheet" />
	<link href="css/Justifiable CSS/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/Justifiable CSS/fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>


<%@ include file="bbb_api.jsp"%>
<%@ page import="java.util.regex.*"%>

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

<%
	if (request.getParameterMap().isEmpty()) {
		//
		// Assume we want to create a meeting
		//
%>

	<div id="portfolio2">
		<div id="accueil">
			<span class="arrow-down"></span>
		</div>

		<div class="title">
			<h2>La salle de <span>classe</span></h2>
			<div class="content"><FORM NAME="form1" METHOD="GET">
				Votre nom: 
				<input type="text" autofocus required name="username1" /><INPUT TYPE=hidden NAME=action VALUE="create"> <br /><input class="button-submit" type="submit" value="Créez votre salle" />
			</FORM>
			</div>
			<p>Ce nom sera celui sous lequel vous serez connu au sein de la classe virtuelle. Il servira aussi de nom à votre classe.</p>
		</div>
		<div class="content">

		</div>

<script>
//
// We could have asked the user for both their name and a meeting title, but we'll just use their name to create a title
// We'll use JQuery to dynamically update the button
//
$(document).ready(function(){
    $("input[name='username1']").keyup(function() {
        if ($("input[name='username1']").val() == "") {
        	$("#submit-button").attr('value',"Create meeting" );
        } else {
       $("#submit-button").attr('value',"Créer la table de " +$("input[name='username1']").val());
        }
    });
});
</script>

<%
	} else if (request.getParameter("action").equals("create")) {
		//
		// User has requested to create a meeting
		//

		String username = request.getParameter("username1");
		String meetingID = "Classe de " + username ;

		//
		// This is the URL for to join the meeting as moderator
		//
		String joinURL = getJoinURL(username, meetingID, "false", "<br>Bienvenue dans la %%CONFNAME%%.<br>", null, null);

		String url = BigBlueButtonURL.replace("bigbluebutton/","demo/");
		String inviteURL = url + "create.jsp?action=invite&meetingID=" + URLEncoder.encode(meetingID, "UTF-8");
%>

	<div id="portfolio2">
			<div id="accueil">
				<span class="arrow-down"></span>
			</div>

			<div class="title">
				<h2>La salle de <span>classe</span></h2>
			</div>
			<div class="content">
				<p><h3>Votre table a été créée!</h3> <a href="<%=joinURL%>" class="button">Rejoindre!</a></p>
				<p>Vous pouvez inviter d'autres utilisateurs avec ce lien: 			
					<form name="form2" method="POST">
						<textarea cols="62" rows="5" name="myname" style="overflow: hidden"><%=inviteURL%></textarea>
					</form>
				</p>
			</div>
	</div>


<%
	} else if (request.getParameter("action").equals("enter")) {
		//
		// The user is now attempting to joing the meeting
		//
		String meetingID = request.getParameter("meetingID");
		String username = request.getParameter("username");

		String url = BigBlueButtonURL.replace("bigbluebutton/","demo/");
		String enterURL = url + "create.jsp?action=join&username="
			+ URLEncoder.encode(username, "UTF-8") + "&meetingID="
			+ URLEncoder.encode(meetingID, "UTF-8");

		if (isMeetingRunning(meetingID).equals("true")) {
			//
			// The meeting has started -- bring the user into the meeting.
			//
%>
<script type="text/javascript">
	window.location = "<%=enterURL%>";
</script>
<%
	} else {
			//
			// The meeting has not yet started, so check until we get back the status that the meeting is running
			//
			String checkMeetingStatus = getURLisMeetingRunning(meetingID);
%>

<script type="text/javascript">
$(document).ready(function(){
		$.jheartbeat.set({
		   url: "<%=checkMeetingStatus%>",
		   delay: 5000
		}, function () {
			mycallback();
		});
	});


function mycallback() {
	// Not elegant, but works around a bug in IE8 
	var isMeetingRunning = ($("#HeartBeatDIV").text().search("true") > 0 );

	if (isMeetingRunning) {
		window.location = "<%=enterURL%>"; 
	}
}
</script>


<h2><strong><%=meetingID%></strong> has not yet started.</h2>



<table width=600 cellspacing="20" cellpadding="20"
	style="border-collapse: collapse; border-right-color: rgb(136, 136, 136);"
	border=3>
	<tbody>
		<tr>
			<td width="50%">

			<p>Hi <%=username%>,</p>
			<p>Now waiting for the moderator to start <strong><%=meetingID%></strong>.</p>
			<br />
			<p>(Your browser will automatically refresh and join the meeting
			when it starts.)</p>
			</td>
			<td width="50%"><img src="polling.gif"></img></td>
		</tr>
	</tbody>
</table>


<%
}
	} else if (request.getParameter("action").equals("invite")) {
		//
		// We have an invite to an active meeting.  Ask the person for their name 
		// so they can join.
		//
		String meetingID = request.getParameter("meetingID");
%>


<div id="portfolio2">
		<div id="accueil">
			<span class="arrow-down"></span>
		</div>

		<div class="title">
			<h2>La salle de <span>classe</span></h2>
			<p>Vous souhaitez rejoindre une salle. rentrez ci-dessous le nom sous lequel vous serez connu dans la salle de classe:</p>


			<div class="content">
				<FORM NAME="form1" METHOD="GET">
				<input type="text" name="username" /> <INPUT TYPE=hidden NAME=meetingID VALUE="<%=meetingID%>"> <INPUT TYPE=hidden NAME=action VALUE="enter">	<input type="submit" class="button-submit" value="Rejoindre" />
				</FORM>
			</div>
		</div>
		<div class="content">

		</div>





<%
	} else if (request.getParameter("action").equals("join")) {
		//
		// We have an invite request to join an existing meeting and the meeting is running
		//
		// We don't need to pass a meeting descritpion as it's already been set by the first time 
		// the meeting was created.
		String joinURL = getJoinURLViewer(request.getParameter("username"), request.getParameter("meetingID"));
			
		if (joinURL.startsWith("http://")) {
%>

<script language="javascript" type="text/javascript">
  window.location.href="<%=joinURL%>";
</script>

<%
	} else { 
%>

Error: getJoinURL() failed
<!--<p /><%=joinURL%> -->

<%
 	}
 }
 %> 

<!--<%@ include file="demo_footer.jsp"%>-->
</div>
</div>
<div id="copyright">
	<p>Copyright (c) 2013 Sitename.com. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>
</body>
</html>
