<?php
require_once '../simpletest/autorun.php';
require_once '../class/Rover.php';

class TestPosition extends UnitTestCase {
    function testFinalPosition1() {
        $marsRover = new Rover();
        $marsRover->setPlanetSize('5 5');
        $marsRover->explore('1 2 N', 'LMLMLMLMM');
        
        $this->assertEqual(
            $marsRover->getCurrentPosition(),
            '1 3 N'
        );
    }
    
    function testFinalPosition2() {
        $marsRover = new Rover();
        $marsRover->setPlanetSize('5 5');
        $marsRover->explore('3 3 E', 'MMRMMRMRRM');
        
        $this->assertEqual(
            $marsRover->getCurrentPosition(),
            '5 1 E'
        );
    }
}