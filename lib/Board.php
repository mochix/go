<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

class Board {

    private $row = 0;

    private $board = [];

    public function __construct($row = 19){
        $this->row = $row;
        $this->board = array_fill(0, $this->row * $this->row, 0);
    }

    public function getRow() {
        return $this->row;
    }

    public function getCount() {
        return count($this->board);
    }

    public function getDisk($row, $col) {
        $num = $row * $this->row + $col;
        return $this->board[$num];
    }

    public function setDisk($row, $col, $disk){
        $num = $row * $this->row + $col;
        $this->board[$num] = $disk;
    }

    // 一時的
    public function getBoard(){
        return $this->board;
    }

    public function isFull() {
        foreach ($this->board as $disk) {
            if ($disk === 0 /* temp */ ) {
                return false;
            }
        }
        return true;
    }

    public function isInclude($index){
        $range = ['min_range' => 0, 'max_range' => $this->row - 1];
        if(filter_var($index, FILTER_VALIDATE_INT, ['options' => $range]) === false){
            return false;
        }
        return true;
    }

}