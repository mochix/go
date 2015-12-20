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
}
