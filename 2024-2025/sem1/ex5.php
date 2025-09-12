<?php

$numbers = [3, 7, 2, 9, 5];
$maxNumber = 0;

for($i = 0; $i < sizeof($numbers); $i++)
{
    if($numbers[$i] > $maxNumber)
    {
        $maxNumber=$numbers[$i];
    }
}
echo $maxNumber;

?>