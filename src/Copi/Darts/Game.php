<?php

namespace Copi\Darts;

abstract class Game
{
    const TRIALS_NUMBER = 3;

    protected $players;
    private $inactivePlayers;
    protected $throws;


    abstract public function checkIsWinner(Player $player);

    public function __construct($players)
    {
        $this->players = $players;
        foreach($players as $player) {
            $this->throws[$player->getName()] = [];
        }
    }

    public function getActivePlayers()
    {
        return $this->players;
    }

    public function setInactivePlayer(Player $player)
    {
        foreach ($this->players as $key => $activePlayer) {
            if ($player == $activePlayer) {
                unset($this->players[$key]);
            }
        }
        $this->inactivePlayers[] = $player;
    }

    public function getInactivePlayers()
    {
        return $this->inactivePlayers;
    }

    public function playerThrown(Player $player, ThrowDart $throw)
    {
        $this->throws[$player->getName()][] = $throw;

        if ($this->checkIsWinner($player)) {
            $this->setInactivePlayer($player);
        }
    }

    public function getPlayerThrows(Player $player)
    {
             return $this->throws[$player->getName()];
    }

    public function getWinner()
    {
        return $this->inactivePlayers[0];
    }
}
