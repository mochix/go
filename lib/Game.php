<?php

namespace Mochix\Go;

use Mochix\Go\Disk;
use Mochix\Go\Board;

class Game {
	
	private $row = 0;

	private $turn = Disk::DISK_BLACK;

	public function __construct($row = 19, $turn = Disk::DISK_BLACK) {
		$this->row  = $row;
		$this->turn = $turn;
	}

	public function getTurn() {
		return $this->turn;
	}

	public function next() {
		$this->turn = ($this->turn === Disk::DISK_BLACK) ? Disk::DISK_WHITE : Disk::DISK_BLACK;
	}
}