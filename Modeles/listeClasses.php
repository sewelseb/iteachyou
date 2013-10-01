<?php

/* _____ PHP Big Blue Button API Usage ______
* by Peter Mentzer peter@petermentzerdesign.com
* Use, modify and distribute however you like.
*/

// Require the bbb-api file:
require_once('bbb-api-php/includes/bbb-api.php');

$bbb = new BigBlueButton();

$itsAllGood = true;
try {$result = $bbb->getMeetingsWithXmlResponseArray();}
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
	// We got an XML response, so let's see what it says:
		if ($result['returncode'] == 'SUCCESS') {		
			for ($i=0; $i < (count($result)-3); $i++){
			//On récupère les Id de toutes les classes en cours
				$meetingsIdArray[$i]= $result[$i]['meetingId'];	
				$meetingsPwArray[$i]= $result[$i]['moderatorPw'];		
			}	
		}
		else {
			echo "<p>We didn't get a success response. Instead we got this:</p>";
			print_r($result);
		}	
	}
}
//Ensuite, on va récupérer les infos nécessaires sur ces diffrents meetings, avec getMeetingInfo


for ($i=0; $i<count($meetingsIdArray); $i++){
$itsAllGood = true;
$infoParams = array(
	'meetingId' => $meetingsIdArray[$i], 		// REQUIRED - We have to know which meeting.
	'password' => $meetingsPwArray[$i],			// REQUIRED - Must match moderator pass for meeting.
);

try {$result = $bbb->getMeetingInfoWithXmlResponseArray($infoParams);}
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
			if (!isset($result['messageKey'])) {
				// Then do stuff ...
				for ($j=0; isset($result[$j]); $j++){
					$utilisateur[$j][] = $result[$j];
				}
			}
			else {
				echo "<p>Failed to get meeting info.</p>";
			}
		}
	}	
}
?>