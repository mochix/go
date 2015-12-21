<?php

/**
 * @package    Mochix\Go
 * @license    MIT License
 * @version    1.0.0
 */

namespace Mochix\Go;

/**
 *	The Disk class.
 */
class Disk {

	/**
     *  [Int] 石の配置状態が空白である.
     */
    const DISK_EMPTY = 0;

    /**
     *  [Int] 石の配置状態が黒(先行側)である.
     */
    const DISK_BLACK = 1;

    /**
     *  [Int] 石の配置状態が白(後攻側)である.
     */
    const DISK_WHITE = 2;
}