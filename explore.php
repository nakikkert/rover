<?php
require_once 'class/Rover.php';

// Create new rover and specify planet size.
$marsRover = new Rover();

$marsRover->setPlanetSize('5 5');

$marsRover->explore('1 2 N', 'LMLMLMLMM');

echo $marsRover->getCurrentPosition() . "\n";
