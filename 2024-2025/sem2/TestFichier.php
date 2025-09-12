<?php
$fp = fopen('films.txt', 'rb');
$tableau=  fgetcsv($fp, 1024, " "); 
fclose($fp); 
var_dump($tableau);
?>