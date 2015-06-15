<?php

namespace Copi\Darts\Game;

use Copi\Darts\Game;
use Copi\Darts\Player;

class AroundTheClock extends Game
{

    public function getScore(Player $player)
    {
        $throws = $this->getPlayerThrows($player);
        $score = [];

        if (!empty($throws)) {
            foreach ($throws as $throw) {
                $score[] = $throw->getScore();
            }

            $i = 1;
            while ($i <= 20) {
                if (array_search($i, $score) === false) {
                    break;
                } else {
                    $score = array_slice($score, array_search($i, $score));
                    $i++;
                }
            }

            return $score[0];
        } else {
            return 0;
        }
    }

    public function checkIsWinner(Player $player)
    {
        $score = $this->getScore($player);

        if (isset($score) && $score == 20) {
            return true;
        }
    }
}
