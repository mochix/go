<?php
require_once 'vendor/autoload.php';

use Mochix\Go\Disk;
use Mochix\Go\Board;
use Mochix\Go\Game;

echo "It was placed in the center of the black!" . PHP_EOL;
echo "10 to 10" . PHP_EOL;

$board = new Board(19);
$game  = new Game(19, Disk::DISK_BLACK);

while(!$board->isFull()) {
    $location = input($board, $game->getTurn());
    try {
        if($board->setDisk($location['x'], $location['y'], $game->getTurn())){
            break;
        }
    } catch (\InvalidArgumentException $e) {
        echo "NG" . PHP_EOL;
        continue;
    }
    $game->next();
}


/** 入力関数 **/
function input($board, $turn) {
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