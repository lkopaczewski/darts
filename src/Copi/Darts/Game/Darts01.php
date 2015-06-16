<?php

namespace Copi\Darts\Game;

use Copi\Darts\Game;
use Copi\Darts\Player;

class Darts01 extends Game
{
    protected $initialScore;
    protected $doublein = false;
    protected $doubleout = false;

    public function __construct($initialScore, $players, $modifications)
    {
        parent::__construct($players);
        $this->initialScore = $initialScore;
        $this->setDoublein($modifications['doublein']);
        $this->setDoubleout($modifications['doubleout']);
    }

    public function getInitialScore()
    {
        return $this->initialScore;
    }

    public function setDoublein($doublein)
    {
        $this->doublein = $doublein;

        foreach ($this->getActivePlayers() as $player) {
            if (! $this->getDoubleIn()) {
                $player->setInGame(true);
            }
        }
    }

    public function getDoublein()
    {
        return $this->doublein;
    }

    public function setDoubleout($doubleout)
    {
        $this->doubleout = $doubleout;
    }

    public function getDoubleout()
    {
        return $this->doubleout;
    }

    public function getDoubleinIndex(Player $player)
    {
        foreach ($this->getPlayerThrows($player) as $key => $playerThrow) {
            if ($playerThrow->getMultiplier() == 2) {
                $player->setInGame(true);

                return $key;
            }
        }
    }

    public function getScore(Player $player)
    {
        $playerThrows = $this->getPlayerThrows($player);
        $sum = 0;

        if ($this->doublein && !empty($playerThrows)) {
            $playerThrows = array_slice($playerThrows, $this->getDoubleinIndex($player));
        }

        if (!empty($playerThrows)) {
            foreach ($playerThrows as $playerThrow) {
                $tempSum = $playerThrow->calculateThrowPoints();

                if ($this->doubleout) {
                    if ($sum + $tempSum <= $this->initialScore - 2 ||
                        $sum + $tempSum == $this->initialScore && $playerThrow->getMultiplier() == 2
                    ) {
                        $sum += $tempSum;
                    }
                } else {
                    if ($sum + $tempSum <= $this->initialScore) {
                        $sum += $tempSum;
                    }
                }
            }
        }

        return $sum;
    }

    public function checkIsWinner(Player $player)
    {
        if ($this->getScore($player) == $this->initialScore) {
            return true;
        }
    }
}
