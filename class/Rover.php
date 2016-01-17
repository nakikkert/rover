<?php
/*
 * Class Rover, explore a section of Mars using specified coordinates and command.
 */
class Rover {
    /*
     * @var Int The max x coordinate of the planet
     */
    private $maxX = 0;
    
    /*
     * @var Int The max y coordinate of the planet
     */
    private $maxY = 0;
    
    /*
     * @var Int The current x position of the rover
     */
    private $x = null;
    
    /*
     * @var Int The current y position of the rover
     */
    private $y = null;
    
    /*
     * @var String The current facing direction of the rover
     */
    private $facing = null;
    
    /*
     * @var Boolean False by default, true when rover is out of bounds
     */
    private $crash = false;
    
    /*
     * Contructor.
     *
     * @return void
     */
    public function __construct() {
    }
    
    /*
     * Set the safe boundary size/maximum area to explore on the planet.
     *
     * @param String $size The planetsize/maximum coordinates (i.e. "5 5")
     */
    public function setPlanetSize($size) {
        list ($x, $y) = explode(' ', $size);
        
        $this->maxX = $x;
        $this->maxY = $y;
    }
    
    /*
     * Let rover explore the planet.
     *
     * @param String $startDirection The start position (i.e. "1 2 N")
     * @param String $command The command with direction (i.e. "LMLR")
     * @return void
     */
    public function explore($startPosition, $command) {
        // Extract the start position into separate elements.
        list ($startX, $startY, $startDirection) = explode(' ', $startPosition);
        
        // Store start position.
        $this->x = $startX;
        $this->y = $startY;
        $this->facing = $startDirection;
        
        // Extract the command.
        $commands = str_split($command);
        
        foreach ($commands as $nextCommand) {
            if ($nextCommand === 'L' || $nextCommand === 'R') {
                $this->turn($nextCommand);
            } else if ($nextCommand === 'M') {
                $this->move();
            }
        }
    }
    
    /*
     * Turn the rover in (counter) clockwise direction.
     *
     * @param String $direction The direction to turn
     * @return void
     */
    private function turn($direction) {
        if ($this->facing === 'N') {
            // Currently facing North.
            $this->facing = ($direction === 'L' ? 'W' : 'E');
        } else if ($this->facing === 'E') {
            // Currently facing East.
            $this->facing = ($direction === 'L' ? 'N' : 'S');
        } else if ($this->facing === 'S') {
            // Currently facing South.
            $this->facing = ($direction === 'L' ? 'E' : 'W');
        } else if ($this->facing === 'W') {
            // Currently facing South.
            $this->facing = ($direction === 'L' ? 'S' : 'N');
        }
    }
    
    /*
     * Move the rover one square into the facing direction.
     *
     * @return void
     */
    private function move() {
        if ($this->facing === 'N') {
            $this->y++;
        } else if ($this->facing === 'E') {
            $this->x++;
        } else if ($this->facing === 'S') {
            $this->y--;
        } else if ($this->facing === 'W') {
            $this->x--;
        }
        
        // Check if we are still on the planet.
        if (($this->x < 0 || $this->x > $this->maxX) || ($this->y < 0 || $this->y > $this->maxY)) {
            // Out of safe planet boundaries.
            $this->crash = true;
        }
    }
    
    /*
     * Check if rover has crashed.
     *
     * @return Boolean True if rover has exceeded boundaries
     */
    public function hasCrashed() {
        return $this->crash;
    }
    
    /*
     * Get the current position of the rover.
     *
     * @return String Current position (i.e. "1 2 N")
     */
    public function getCurrentPosition() {
        return implode(' ', array($this->x, $this->y, $this->facing));
    }
}