<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

use Mochix\Go\Disk;
use Mochix\Go\Board;
use Mochix\Go\Playable;

/**
 *  The game class.
 */
class Game implements \IteratorAggregate 
{
	/**
     *  @var int $turn   ターン状態.
     */
	private $turn = Disk::DISK_BLACK;

	/**
     *  @var Board $board 　	ゲーム盤面を保持.
     */
	protected $board = null;

	/**
     *  @var Array $board 　	登録されたプレイヤー.
     */
	protected $players = [];

	/**
     *  コンストラクタ.
     *
     *  @access public
     *  @param  int $row    盤面の行数を指定する(初期値は19).
     *	@param  int $turn   先行側の色を指定する(初期値は黒).
     */
	public function __construct($row = 19, $turn = Disk::DISK_BLACK) 
	{
		$this->board = new Board($row);
		$this->turn  = $turn;
	}

	/**
     *  指定したプレイヤーを登録する.
     *
     *  @access public
     *  @param  Playable $row.	登録するプレイヤー.
     *	@param  int $turn   	登録するプレイヤーの色を指定する.
     */
	public function setPlayer(Playable $player, $turn)
	{
		$this->players[$turn] = $player;
	}

	/**
	 *	ゲーム管理クラスをforeachでゲームループを回すように、IteratorAggregate に適合する
	 *
	 *  @access public
	 */
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
        		$this->turn = ($this->turn === Disk::DISK_BLACK) ? Disk::DISK_WHITE : Disk::DISK_BLACK;
        	// 同じ位置に対する入力があった場合
    		} catch  (\InvalidArgumentException $e) {
    			$player->isSame();
    			continue;
    		}
    	}
    }

    /**
     * ターン状態を取得する.
     *
     * @access  public
     * @return  int
     */
	public function getTurn() 
	{
		return $this->turn;
	}
}