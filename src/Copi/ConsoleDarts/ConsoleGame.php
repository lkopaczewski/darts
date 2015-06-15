<?php

namespace Copi\ConsoleDarts;

use Copi\Darts\GameFactory;
use Copi\Darts\Player;
use Copi\Darts\ThrowDart;
use Copi\Darts\Game;

class ConsoleGame
{
    private $console;
    private $gameFactory;
    private $game;

    public function __construct(Console $console, GameFactory $gameFactory)
    {
        $this->console = $console;
        $this->gameFactory = $gameFactory;
    }

    public function run()
    {
        $players = $this->selectPlayers();
        $this->choiceGame($players);
        $this->gameLoop();
    }

    public function choice()
    {
        $choice = $this->console->readline();
        if ($choice == 'T' || $choice == null) {
            return true;
        }
    }

    private function choiceGame($players)
    {
        $modifications = [];
        $games = $this->gameFactory->getGames();

        foreach ($games as $key => $game) {
            $this->console->writeline($key.': '.$game."\n");
        }

        $choiceGame = $this->console->readline();
        $modifiers = $this->gameFactory->getModifiers($games[$choiceGame]);

        foreach ($modifiers as $modifier) {
            $this->console->writeline($modifier.'? [T/n]: ');
            ($this->choice()) ? $modifications[$modifier] = true : $modifications[$modifier] = false;
        }
        $this->game = $this->gameFactory->create($games[$choiceGame], $players, $modifications);
    }

    private function selectPlayers()
    {
        $players = [];

        do {
            if (empty($players)) {
                $this->console->writeline('Podaj nick pierwszego gracza: ');
                $players[] = (new Player($this->console->readline()));
                $this->console->writeline('Podaj nick drugiego gracza: ');
                $players[] = (new Player($this->console->readline()));
            }

            $this->console->writeline('Chcesz dodać następnego gracza? [T/n]: ');

            $nextPlayer = $this->choice();

            if ($nextPlayer) {
                $this->console->writeline('Podaj nick gracza: ');
                $players[] = (new Player($this->console->readline()));
            }
        } while ($nextPlayer);

        return $players;
    }

    private function gameLoop()
    {
        while (count($this->game->getActivePlayers()) > 1) {
            foreach ($this->game->getActivePlayers() as $player) {
                for ($i = 1; $i <= Game::TRIALS_NUMBER; $i++) {

                    $score = $this->game->getScore($player);

                    $this->console->writeline("\nRzuca ".$player->getName()." [".$score."] :");

                    $throw = $this->console->readline();
                    $throw = explode('x', $throw);

                    $score = $throw[0];
                    isset($throw[1]) ? $multiplier = $throw[1] : $multiplier = 1;

                    $throwObj = new ThrowDart($score, $multiplier);
                    $this->game->playerThrown($player, $throwObj);
                }
            }
        }
    }

}