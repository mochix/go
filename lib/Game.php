<?php

namespace Mochix\Go;

use Mochix\Go\Disk;
use Mochix\Go\Board;
use Mochix\Go\Playable;

/**
 *
 *
 */
class Game implements \IteratorAggregate {
	private $turn = Disk::DISK_BLACK;

	protected $board = null;

	protected $players = [];

	public function __construct($row = 19, $turn = Disk::DISK_BLACK) {
		$this->board = new Board($row);
		$this->turn  = $turn;
	}

	public function setPlayer(Playable $player, $turn){
		$this->players[$turn] = $player;
	}

	public function getIterator()
    {
    	// ゲームループ.
    	while(!$this->board->isFull())
    	{
    		// ターンのプレイヤーを取得.
    		$player = $this->players[$this->turn];
    		try 
    		{
    			// 入力値を取得.今は入力信頼.本来はちゃんとチェックする
    			$location = $player->input($this->board, $this->turn);
    			// 盤面に置く。
    			if($this->board->setDisk($location['x'], $location['y'], $this->turn))
    			{
    				// 勝利条件が成立
            		break;
        		}
        		// 勝利条件が不成立.
        		yield $this->turn => $this->board;
        		// ターンを次へ
        		$this->next();
        	// 同じ位置に対する入力があった場合
    		} catch  (\InvalidArgumentException $e) {
    			$player->isSame();
    			continue;
    		}
    	}
    }

	public function getTurn() {
		return $this->turn;
	}

	private function next() {
		$this->turn = ($this->turn === Disk::DISK_BLACK) ? Disk::DISK_WHITE : Disk::DISK_BLACK;
	}
}