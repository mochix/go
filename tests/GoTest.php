<?php

/**
 *
 *
 */    
namespace Mochix\Go\Test;

use Mochix\Go\Game;
use Mochix\Go\Disk;
use Mochix\Go\Playable;

class Black implements Playable {
    
    /**
     *  @var int $row
     */
    protected $row = 0;

    /**
     *  @var int $col
     */
    protected $col = 0;

    /**
     *  @var int $index
     */
    protected $index = 0;
    

    public function __construct($row, $col)
    {
        $this->row = $row;
        $this->col = $col;
    }

    public function input($board, $turn)
    {
        $location = [];
        $location['x'] = 9 + ($this->row * $this->index);
        $location['y'] = 9 + ($this->col * $this->index);
        $this->index++;
        return $location;
    }

    public function isSame(){}
}

class White implements Playable
{
    protected $index = 0;

    protected $position = [
        ['x' =>  2, 'y' =>  2],
        ['x' => 18, 'y' => 18],
        ['x' =>  1, 'y' =>  1],
        ['x' => 17, 'y' => 17]];

    public function input($board, $turn)
    {
        return $this->position[$this->index++];
    }

    public function isSame(){}
}

class Middle implements Playable
{
    protected $index = 0;

    protected $position = [
        ['x' =>  0, 'y' => 0],
        ['x' =>  0, 'y' => 4],
        ['x' =>  0, 'y' => 1],
        ['x' =>  0, 'y' => 3],
        ['x' =>  0, 'y' => 2]
    ];

    public function input($board, $turn)
    {
        return $this->position[$this->index++];
    }

    public function isSame(){}
}




class GoTest extends \PHPUnit_Framework_TestCase
{
    protected $instance = null;

    protected function setUp()
    {
        $this->instance = new Game();
    }

    /**
     *  @dataProvider provideDistances
     */
    public function testGameLoop($row, $col)
    {
        $this->assertEquals(false, $this->instance->getWinner());
        $this->instance->setPlayer(new Black($row, $col), Disk::DISK_BLACK);
        $this->instance->setPlayer(new White(), Disk::DISK_WHITE);
        foreach($this->instance as $turn => $board){
        
        }
        $this->assertEquals(true, $this->instance->getWinner());
    }

    public function testMiddle()
    {
        $this->assertEquals(false, $this->instance->getWinner());
        $this->instance->setPlayer(new Middle(), Disk::DISK_BLACK);
        $this->instance->setPlayer(new White() , Disk::DISK_WHITE);
        foreach($this->instance as $turn => $board){
            
        }
        $this->assertEquals(true, $this->instance->getWinner());
    }



    public function provideDistances()
    {
        return [[0,1],[0,-1],[1,0],[-1,0],[1,1],[1,-1],[-1,1],[-1,-1]];
    }

}




