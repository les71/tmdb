<?php

namespace record;

/*
 * Toldylaszlo.hu
 * 2021
  TMDB loader

  namespace record;

  /**
 * Record class of director
 *
 * @author tl
 */

class director {

    public $Id;
    public $Name;
    public $Biography;
    public $DateOfBirth;
    
    /**
     * 
     * @param type $PersonData TMDB person result json->stdclass
     * @return \record\director
     */
    
    public static function parse($PersonData) {
        $Record = new director();

        $Record->Id = $PersonData->id;
        $Record->Name = $PersonData->name;
        $Record->Biography = $PersonData->biography;
        $Record->DateOfBirth = $PersonData->birthday;
        return $Record;
    }

}
