<?php

class Autoload
{

    public function __construct()
    {
        $files = scandir(__DIR__ . "/");

        foreach ($files as $row) {
            if (!in_array($row, ['.', '..'])) {
                include_once $row;
            }
        }
    }
}
