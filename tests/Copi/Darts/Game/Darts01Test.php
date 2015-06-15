<?php

namespace Copi\Darts\Game\Tests;

use Copi\Darts\GameFactory;
use Copi\Darts\Player;
use Copi\Darts\ThrowDart;

class Darts01Test extends \PHPUnit_Framework_TestCase
{
    private $game;
    private $players = [];

    protected function setUp()
    {
        $this->players[] = new Player('Janusz');
        $this->players[] = new Player('Halina');

        $modifications = ['doublein' => false, 'doubleout' => false];

        $this->game = (new GameFactory())->create('101',$this->players, $modifications);

        $throw = new ThrowDart(20, 3);
        $this->game->playerThrown($this->players[0], $throw);

    }

    public function testGetScore()
    {
        $score = $this->game->getScore($this->players[0]);
        $this->assertEquals(60, $score);
    }
}