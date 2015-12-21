<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

require_once 'utils.php';

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
        if ($this->getDisk($row, $col) !== 0) {
            throw new \InvalidArgumentException('');
        }
        $num = $row * $this->row + $col;
        $this->board[$num] = $disk;

        return $this->isWin($row, $col, $disk);
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

    private function isWin($row, $col, $turn)
    {
        $point_search = \point_search($row, $col, $this->row, $turn, $this->board);
        return \win_conditions($point_search);
    }

    public function isInclude($index){
        $range = ['min_range' => 0, 'max_range' => $this->row - 1];
        if(filter_var($index, FILTER_VALIDATE_INT, ['options' => $range]) === false){
            return false;
        }
        return true;
    }

}
