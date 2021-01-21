<?php

namespace record;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace record;

  /**
 * Description of toprated
 *
 * @author tl
 */

class toprated {
    
    public $Id;
    public $Place;
    public $Title;
    public $VoteAverage;
    public $VoteCount;
    
    /**
     * 
     * @param type $MovieData TMDB movie result json->stdclass 
     * @param type $Place  placement order 1-210
     * @return \record\toprated
     */
    
    public static function parse($MovieData,$Place) {
        $Record = new toprated();

        $Record->Id = $MovieData->id;
        $Record->Place = $Place;
        $Record->Title = $MovieData->title;
        $Record->VoteAverage = $MovieData->vote_average;
        $Record->VoteCount = $MovieData->vote_count;
        return $Record;
    }

}
