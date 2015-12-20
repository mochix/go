<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

class Board {

    private $row = 0;

    public function __construct($row = 19){
        $this->row = $row;
    }

    public function getRow() {
        return $this->row;
    }

    public function isInclude($index){
        $range = ['min_range' => 0, 'max_range' => $this->row - 1];
        if(filter_var($index, FILTER_VALIDATE_INT, ['options' => $range]) === false){
            return false;
        }
        return true;
    }

}
