<?php

require_once __DIR__.'/vendor/autoload.php';

use Copi\ConsoleDarts\ConsoleGame;
use Copi\ConsoleDarts\Console;
use Copi\Darts\GameFactory;

$consoleGame = new ConsoleGame(new Console(), new GameFactory());
$consoleGame->run();