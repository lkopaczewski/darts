<?php

namespace Copi\Darts;

class Player
{
    private $name;
    private $inGame = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setInGame($inGame)
    {
        $this->inGame = $inGame;
    }

    public function getInGame()
    {
        return $this->inGame;
    }
}
