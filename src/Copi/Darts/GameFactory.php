<?php

namespace Copi\Darts;

use Copi\Darts\Game\Darts01;
use Copi\Darts\Game\AroundTheClock;

class GameFactory
{

    public function create($type, $players, $modifications)
    {
        switch ($type) {
            case '1001':
                return new Darts01(1001, $players, $modifications);
                break;
            case '501':
                return new Darts01(501, $players, $modifications);
                break;
            case '301':
                return new Darts01(301, $players, $modifications);
                break;
            case '101':
                return new Darts01(101, $players, $modifications);
                break;
            case 'Clock':
                return new AroundTheClock($players);
                break;
        }
    }

    public function getGames()
    {
        return [
            1 => 'Clock',
            2 => '101',
            3 => '301',
            4 => '501',
            5 => '1001'
        ];
    }

    public function getModifiers($gameType)
    {
        if (in_array($gameType, ['1001', '501', '301', '101'])) {
            return ['doublein', 'doubleout'];
        } else {
            return [];
        }
    }
}
