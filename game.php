<?php

require_once __DIR__.'/vendor/autoload.php';

use Copi\Darts\Player;
use Copi\Darts\GameFactory;
use Copi\Darts\ThrowDart;
use Copi\Darts\Game;

$players[] = new Player('Janusz');
$players[] = new Player('Halina');
$players[] = new Player('Roman');

$game = (new GameFactory())->create('501',$players, $modifications = []);



$game->setDoublein(true);
$game->setDoubleout(true);

while (count($game->getActivePlayers()) > 1) {
    foreach ($game->getActivePlayers() as $player) {
        for ($i = 1; $i <= Game::TRIALS_NUMBER; $i++) {
            $throw = new ThrowDart(mt_rand(0, 20), mt_rand(1, 3));
            $game->playerThrown($player, $throw);
        }
    }
}

echo $game->getWinner()->getName();
