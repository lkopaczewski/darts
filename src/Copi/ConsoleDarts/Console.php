<?php

namespace Copi\ConsoleDarts;

class Console
{
    private $handle;

    public function __construct()
    {
        $this->handle = fopen ("php://stdin","r");
    }

    public function __destruct()
    {
        fclose($this->handle);
    }

    public function readline()
    {
        return trim(fgets($this->handle, 1024), "\r\n");
    }

    public function writeline($out)
    {
        echo $out;
    }
}