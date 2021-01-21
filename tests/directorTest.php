<?php

require_once 'helper/functions.php';
require_once 'itest.php';

class directorTest extends itest {

    public function testCanBeSaveDirector(): void {
        $this->expectOutputString('Frank Darabont'); //'id' => 4027

        $Registry = $this->createRegistry();

        $Toprate = new movies\directors($Registry, new \tests\classes\loader\director($Registry), new \tests\classes\output\director($Registry));
        $Toprate->load();
    }

}
