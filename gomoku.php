<?php
require_once 'vendor/autoload.php';

use Mochix\Go\Disk;
use Mochix\Go\Board;
use Mochix\Go\Game;
use Mochix\Go\Playable;

class Player implements Playable {

    /** 入力関数 */
    public function input($board, $turn) {
        $location = [];
        foreach(['x','y'] as $index) {
            while(true) {
                $message = ($turn === Disk::DISK_BLACK) ? "black" : "white";
                echo $message . strtoupper($index) . ':';
                $disk = trim(fgets(STDIN));
                if (!$board->isInclude($disk)) {
                    echo "once again" . PHP_EOL;
                    continue;
                }
                $location[$index] = $disk;
                break;
            }
        }
        return $location;
    }

    public function isSame(){
        echo 'NG' . PHP_EOL;
    }
}



echo "It was placed in the center of the black!" . PHP_EOL;
echo "10 to 10" . PHP_EOL;

// ゲームループ.
$game = new Game(19, Disk::DISK_BLACK);
$game->setPlayer(new Player(), Disk::DISK_BLACK);
$game->setPlayer(new Player(), Disk::DISK_WHITE);

foreach($game as $turn => $board) 
{
    // 画面表示処理.
    foreach($board as $row) {
        foreach($row as $disk){
            if($disk === Disk::DISK_EMPTY){
                echo '-';
            }else if($disk === Disk::DISK_BLACK) {
                echo '●';
            }else if($disk === Disk::DISK_WHITE) {
                echo '○';
            }
        }
        echo PHP_EOL;
    }
}