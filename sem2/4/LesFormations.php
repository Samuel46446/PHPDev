<?php
// Example usage
$formation = new Formation("PHP Development", "Learn the basics of PHP programming.");
$session = new Session("2023-10-15", $formation);
$participant = new Participant("John Doe", "john.doe@example.com");

echo "Formation: " . $formation->getTitle() . "\n";
echo "Description: " . $formation->getDescription() . "\n";
echo "Session Date: " . $session->getDate() . "\n";
echo "Participant: " . $participant->getName() . "\n";
echo "Email: " . $participant->getEmail() . "\n";
?>
