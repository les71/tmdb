<?php

require_once 'helper/functions.php';
require_once 'itest.php';

/**
 * download first page of top rated API and check number of record==20
 */

class topratedTest extends itest{
    
    public function testCanBeSaveTopRate(): void
    {
        $this->expectOutputString('count:20');
        
        $Registry = $this->createRegistry();

        $Toprate=new movies\toprated($Registry, new \tests\classes\loader\toprated($Registry), new \tests\classes\output\toprated($Registry));
        $Toprate->load();
    }
    
}

