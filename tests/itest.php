<?php
use PHPUnit\Framework\TestCase;
/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader


  /**
 * Base class of tests
 *
 * @author tl
 */

class itest extends TestCase{

    protected function createRegistry() {
        $Registry = new helper\Registry();
        $Registry->set('log', new \tests\helper\log());
        $Registry->set('console', new \tests\helper\console());
        return $Registry;
    }

}
