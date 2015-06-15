<?php

namespace Copi\Darts;

class ThrowDart
{
    private $score;
    private $multiplier;

    public function __construct($score, $multiplier)
    {
        if ($score == 50 || $score == 25 || ($score >= 0 && $score <= 20)) {
            $this->score = $score;
        }
        if ($score == 50 || $score == 25) {
            $multiplier = 1;
        }
        if ($multiplier >= 1 && $multiplier <= 3) {
            $this->multiplier = $multiplier;
        }
    }

    public function getMultiplier()
    {
        return $this->multiplier;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function calculateThrowPoints()
    {
        return ($this->score * $this->multiplier);
    }
}
