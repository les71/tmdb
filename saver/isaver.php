<?php

namespace saver;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace saver;

  /**
 * base class of saver classes
 *
 *
 * @author tl
 */

abstract class isaver extends \helper\Controller{

    public function save($Records) {
        foreach ($Records as $Record) {
            $this->saveRecord($Record);
        }
    }

    protected abstract function saveRecord($Record);
}
