<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

use Mochix\Go\Disk;

require_once 'utils.php';

/**
 *  The board class.
 */
class Board {

    /**
     *  検索方向[上]
     */
    const DIRECTION_UP = 1;

    /**
     *  検索方向[下]
     */
    const DIRECTION_DOWN = -1;

    /**
     *  検索方向[右]
     */
    const DIRECTION_RIGHT = 2;

    /**
     * 　検索方向[左]
     */
    const DIRECTION_LEFT = -2;

    /**
     *  検索方向[右下]
     */
    const DIRECTION_LOWER_RIGHT = 3;

    /**
     *  検索方向[左上]
     */
    const DIRECTION_UPPER_LEFT = -3;

    /**
     *  検索方向[右上]
     */
    const DIRECTION_UPPER_RIGHT = 4;

    /**
     *  検索方向[右下]
     */
    const DIRECTION_LOWER_LEFT = -4;


    /**
     *  @var array $directions
     *
     *  勝利条件判定時に周辺方向を探索する際に使用するオフセット.
     */
    protected static $directions = [
        Board::DIRECTION_UP          => [-1, 0],
        Board::DIRECTION_DOWN        => [ 1, 0],
        Board::DIRECTION_RIGHT       => [ 0, 1],
        Board::DIRECTION_LEFT        => [ 0,-1],
        Board::DIRECTION_LOWER_RIGHT => [ 1, 1],
        Board::DIRECTION_UPPER_LEFT  => [-1,-1],
        Board::DIRECTION_UPPER_RIGHT => [-1, 1],
        Board::DIRECTION_LOWER_LEFT  => [ 1,-1]
    ];

    /**
     *  @var array $board   盤面状態を管理する一次元配列.
     */
    protected $board = null;

    /**
     *  @var int $row   盤面の行数.
     */
    protected $row = 0;

    /**
     *  コンストラクタ.
     *
     *  @access public
     *  @param  int $row    盤面の行数を指定する(初期値は19).
     */
    public function __construct($row = 19)
    {
        $this->row = $row;

        // 盤面全体を空白状態で埋める（ゲーム開始時は石が一つも配置されていないため）.
        $this->board = array_fill(0, $this->row * $this->row, Disk::DISK_EMPTY);
    }

    /**
     *  盤面の行数を取得する.
     *
     *  @access public
     *  @param  void
     *  @return int
     */
    public function getRow() 
    {
        return $this->row;
    }

    /**
     * 指定された位置の石状態を取得する.
     *
     * @access  public
     * @param   int $row
     * @param   int $col
     * @return  int
     */
    public function getDisk($row, $col) 
    {
        // 指定座標を一次元に変換し、配列から取得する.
        $index = $this->getBoardIndex($row, $col);
        return $this->board[$index];
    }

    /**
     *  指定された位置に石状態を設定し、勝利状態を返却する.
     *
     *  @access public
     *  @param  int $disk
     *  @param  int $row
     *  @param  int $col
     *  @return boolean
     */
    public function setDisk($row, $col, $disk)
    {
        // 指定された位置が盤面の範囲外の場合には、例外(OutOfBoundsException)を送出する.
        if (!$this->isInclude($row) || !$this->isInclude($col)) 
        {
            throw new \OutOfBoundsException('');
        }

        // 指定された位置に既に石が置かれていた場合には、例外(InvalidArgumentException)を送出する.
        if ($this->getDisk($row, $col) !== Disk::DISK_EMPTY) 
        {
            throw new \InvalidArgumentException('');
        }

        // 指定された座標を位置次元に変換し、石状態を配列に設定する.
        $index = $this->getBoardIndex($row, $col);
        $this->board[$index] = $disk;

        // 指定位置に石を配置した場合の勝利判定を実行する.
        return $this->isWin($row, $col, $disk);
    }


    /**
     *  盤面が石で埋め尽くされているか(空白が存在せず、配置場所が存在しない)を判定する.
     *
     *  @access public
     *  @param  void
     *  @return boolean
     */
    public function isFull() 
    {
        // 盤面全ての石状態を確認し、空白が一つでも存在したら、falseとする.
        foreach ($this->board as $disk) {
            if ($disk === Disk::DISK_EMPTY) {
                return false;
            }
        }
        return true;
    }

    /**
     *  盤面状態を二次元配列で取得する.
     *
     *  @access public
     *  @param  void
     *  @return array
     */
    public function getMatrix()
    {
        $matrix = [];
        foreach ($this->board as $index => $disk) {
            $row = (int)($index / $this->row);
            $col = (int)($index % $this->row);
            if ($col === 0) {
                $ret[$row] = [];
            }
            $matrix[$row][$col] = $disk;
        }
        return $matrix;
    }



    /**
     *  勝利条件を満たしているかを確認する.
     *
     *  @access private
     *  @param  int $row
     *  @param  int $col
     *  @param  int $turn
     *  @return boolean
     */
    private function isWin($row, $col, $turn)
    {
        // 指定位置から見た八方向の盤面の状態を取得する.
        $point_search = \point_search($row, $col, $this->row, $turn, $this->board);
        // 取得した周辺状態を元に勝利条件を満たしているかを判定する.
        return \win_conditions($point_search);
    }

    /**
     *  指定された値が範囲内か検出する.
     *
     *  @access private
     *  @param  int $index
     *  @return boolean
     */
    public function isInclude($index)
    {
        // 範囲は0から盤面行数($this->row)-1となる.
        $range = ['min_range' => 0, 'max_range' => $this->row - 1];
        if(filter_var($index, FILTER_VALIDATE_INT, ['options' => $range]) === false)
        {
            return false;
        }
        return true;
    }

    /**
     *  盤面指定($row, $col)を一次元配列に変換する.
     *
     *  @access private
     *  @param  int $row
     *  @param  int $col
     *  @return int
     */
    private function getBoardIndex($row, $col)
    {
        return ($row * $this->row) + $col;
    }
}