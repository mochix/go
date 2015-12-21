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
    foreach(['x','y'] as $index) {
        $point = 'point_' . $index;
        while(true){
            $message = ($game->getTurn() === Disk::DISK_BLACK) ? "black" : "white";

            echo $message . strtoupper($index) . ':';
            $$point = trim(fgets(STDIN));
            if (!$board->isInclude($$point)) {
                echo "once again" . PHP_EOL;
                continue;
            }
            break;
        }
    }

    try {
        if($board->setDisk($point_x, $point_y, $game->getTurn())){
            break;
        }
    } catch (\InvalidArgumentException $e) {
        echo "NG" . PHP_EOL;
        continue;
    }
    $game->next();
}