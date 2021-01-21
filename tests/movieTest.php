<?php

require_once 'helper/functions.php';
require_once 'itest.php';

class movieTest extends itest {

    public function testCanBeSaveMovie(): void {
        $this->expectOutputString('The Godfather;1776'); //'tmdb_id' => 238, director id=1776

        $Registry = $this->createRegistry();

        $Toprate = new movies\directors($Registry, new \tests\classes\loader\movie($Registry), new \tests\classes\output\movie($Registry));
        $Toprate->load();
    }

}
