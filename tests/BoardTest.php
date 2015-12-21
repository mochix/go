<?php

/**
 *
 *
 */
namespace Mochix\Go\Test;

use Mochix\Go\Disk;
use Mochix\Go\Board;


class BoardTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  @var object $instance   テスト対象
     */
    protected $instance = null;

    /**
     *  テストの初期化処理
     */
    protected function setUp()
    {
        $this->instance = new Board(19);
    }

    /**
     *  isFull()のテスト 
     */
    public function testIsFull()
    {
        // 初期状態なので必ず空白は存在するはず.
        $this->assertEquals(false, $this->instance->isFull());
        $count = $this->instance->getRow();
        
        // 盤面全てを黒で埋める
        foreach(\range(0, ($count * $count) - 1) as $index) 
        {
            $row = (int)($index / $count);
            $col = (int)($index % $count);
            $this->instance->setDisk($row, $col, Disk::DISK_BLACK);
        }
        $disk = $this->instance->getDisk(mt_rand(0, 18), mt_rand(0, 18));

        // 盤面全てが黒一色で配置されているので、どれを取っても石は黒のはず
        $this->assertEquals(true, $disk == Disk::DISK_BLACK);
        //　盤面全てが黒一色で配置されているため、空白は存在しないはず
        $this->assertEquals(true, $this->instance->isFull());
    }
}
