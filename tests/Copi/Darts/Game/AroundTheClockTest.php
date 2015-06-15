<?php

namespace Copi\Darts\Game\Tests;

use Copi\Darts\Game\AroundTheClock;
use Copi\Darts\Player;
use Copi\Darts\ThrowDart;

class AroundTheClockTest extends \PHPUnit_Framework_TestCase
{
    private $game;
    private $players = [];

    protected function setUp()
    {
        $this->players[] = new Player('Janusz');
        $this->players[] = new Player('Halina');

        $this->game = new AroundTheClock($this->players, $modifications = []);

        $throw = new ThrowDart(20, 1);
        $this->game->playerThrown($this->players[0], $throw);
        $throw = new ThrowDart(1, 1);
        $this->game->playerThrown($this->players[0], $throw);
        $throw = new ThrowDart(2, 1);
        $this->game->playerThrown($this->players[0], $throw);
        $throw = new ThrowDart(12, 1);
        $this->game->playerThrown($this->players[0], $throw);

        for ($i = 0; $i<=20; $i++) {
            $throw = new ThrowDart($i, 1);
            $this->game->playerThrown($this->players[1], $throw);
        }
    }

    public function testGetScore()
    {
        $scorePlayerOne = $this->game->getScore($this->players[0]);
        $scorePlayerTwo = $this->game->getScore($this->players[1]);

        $this->assertEquals(2, $scorePlayerOne);
        $this->assertEquals(20, $scorePlayerTwo);
    }

    public function testCheckIsWinner()
    {
        $playerOne = $this->players[0];
        $playerTwo = $this->players[1];

        $this->assertEquals(false, $this->game->checkIsWinner($playerOne));
        $this->assertEquals(true, $this->game->checkIsWinner($playerTwo));
    }
}