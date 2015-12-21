<?php

namespace Mochix\Go;

use Mochix\Go\Disk;
use Mochix\Go\Board;

/**
 *
 *
 */
class Game implements \IteratorAggregate {
	private $turn = Disk::DISK_BLACK;


	protected $board = null;

	public function __construct($row = 19, $turn = Disk::DISK_BLACK) {
		$this->board = new Board($row);
		$this->turn  = $turn;
	}

	public function getIterator()
    {
    	while(!$this->board->isFull())
    	{
    		yield $this->turn => $this->board;
    		$this->next();
    	}
    }

	public function getTurn() {
		return $this->turn;
	}

	private function next() {
		$this->turn = ($this->turn === Disk::DISK_BLACK) ? Disk::DISK_WHITE : Disk::DISK_BLACK;
	}
}