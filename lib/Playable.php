<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

/**
 *	The Playable interface.
 */
interface Playable
{
	/**
	 * 	入力要求発生時に呼び出され、盤面に配置する座標を返されることを期待する.
	 */
	public function input($board, $turn);

	/**
	 *	既に配置済みの場所を指定した場合、登録したゲームクラスから呼び出される.
	 */
	public function isSame();
}