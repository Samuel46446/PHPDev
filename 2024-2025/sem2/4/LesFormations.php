<?php

use sem2\use sem2\include_once "Formation.php";
include_once "Participant.php";
include_once "Session.php";
// Example usage
$formation = new Formation("PHP Development", "Learn the basics of PHP programming.", 10);
$session = new Session(1,"2023-10-15", 36);

$formation->affectSessions($session);
$formation->affectParticipants();

?>
