<?php
// Require the bbb-api file:
require_once('bbb-api-php/includes/bbb-api.php');


// Instatiate the BBB class:
$bbb = new BigBlueButton();

//On récupère les paramètres envoyés: Au moins il y aura le nom d'utilisateur et un mot de passe (qui peut êre vide, auquel cas on en attribuera un par défaut (sinon la création de classe plante)
$username = $_POST['username'];
if ($_POST['password'] != ''){
	$password = $_POST['password'];
	}
else{
	$password = 'pw';
	}
	
//On génère le lien d'invite:

//Cas où il faut créer la classe (elle n'existe pas encore)
if ($_POST['action']== 'create'){
	$meetingId='Classe de '.$username;
	$inviteURL = '/index.php?page=rejoindreClasse&meetingId='.$meetingId;
	$welcomeMsg = 'Bienvenue dans la classe de '.$username.'! Vous pouvez inviter des utilisateurs avec le lien suivant: '.$inviteURL;
	
	if (isset($_POST['record'])){
		$record = $_POST['record'];
		}
	
	else{
	$record = 'false';
		}
	
$creationParams = array(
	'meetingId' => $meetingId, 				// REQUIRED
	'meetingName' => 'Classe de '.$username, 	// REQUIRED
	'attendeePw' => 'ap', 					// Match this value in getJoinMeetingURL() to join as attendee.
	'moderatorPw' => $password, 					// Match this value in getJoinMeetingURL() to join as moderator.
	'welcomeMsg' => $welcomeMsg,
	'record' => $record, 					// New. 'true' will tell BBB to record the meeting.
);
// Create the meeting and get back a response:
$itsAllGood = true;
try {$result = $bbb->createMeetingWithXmlResponseArray($creationParams);}
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
		$itsAllGood = false;
	}

if ($itsAllGood == true) {
	// If it's all good, then we've interfaced with our BBB php api OK:
	if ($result == null) {
		// If we get a null response, then we're not getting any XML back from BBB.
		echo "Failed to get any response. Maybe we can't contact the BBB server.";
		}	
	else { 
		//Si ça a marché, on récupère l'URL du meeting:
	
		if ($result['returncode'] == 'SUCCESS') {
			$joinParams = array(
			'meetingId' => $meetingId, 				// REQUIRED - We have to know which meeting to join.
			'username' => $username,		// REQUIRED - The user display name that will show in the BBB meeting.
			'password' => $password,					// REQUIRED - Must match either attendee or moderator pass for meeting.
			);
		
			// Get the URL to join meeting:
			$itsAllGood = true;
			try {$result = $bbb->getJoinMeetingURL($joinParams);}
			catch (Exception $e) {
				echo 'Caught exception: ', $e->getMessage(), "\n";
				$itsAllGood = false;
			}

			if ($itsAllGood == true) {
			//On stocke le lien dans la variable classeURL
				$classeURL=$result;
			}	
		}
	}
}
else {
	echo "<p>Meeting creation failed.</p>";
	}
}

//Si on veut rejoindre une salle
elseif ($_POST['action']=='rejoindre'){

	$meetingId = $_POST['meetingId'];
	//D'abord on vérifie que le meeting existe
	$itsAllGood = true;
	try {$result = $bbb->isMeetingRunningWithXmlResponseArray($meetingId);}
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
		$itsAllGood = false;
	}

	if ($itsAllGood == true) {
		$joinParams = array(
			'meetingId' => $meetingId, 				// REQUIRED - We have to know which meeting to join.
			'username' => $username,		// REQUIRED - The user display name that will show in the BBB meeting.
			'password' => $password,					// REQUIRED - Must match either attendee or moderator pass for meeting.
			);
		
		// Get the URL to join meeting:
		$itsAllGood = true;
		try {$result = $bbb->getJoinMeetingURL($joinParams);}
		catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), "\n";
			$itsAllGood = false;
		}

		if ($itsAllGood == true) {
			//On stocke le lien dans la variable classeURL
			$classeURL=$result;
		}	
	
	}
}

else{

	$classeURL = '/index.php?page=teamrocket';

}

header('Location: '.$classeURL);

?>