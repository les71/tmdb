<?php

namespace record;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace record;

  /**
 * Record class of movie
 *
 * @author tl
 */

class movie {

    public $Id;
    public $Title;
    public $Length;
    public $ReleaseDate;
    public $Overview;
    public $PosterUrl;
    public $VoteAverage;
    public $VoteCount;
    public $TmdbUrl;
    public $Genres;
    public $Directors;

    /**
     * 
     * @param type $MovieData TMDB movie API result json->stdclass
     * @param type $Credits   TMDB credit result json->stdclass (direcot, actor, etc)
     * @return \record\movie
     */
    
    
    public static function parse($MovieData,$Credits) {
        //print_r($MovieData);
        $Record = new movie();

        $Record->Id = $MovieData->id;
        $Record->Title = $MovieData->title;
        $Record->Length = $MovieData->runtime * 60;
        $Record->ReleaseDate = $MovieData->release_date;
        $Record->Overview = $MovieData->overview;
        $Record->PosterUrl = $MovieData->poster_path;
        $Record->TmdbUrl = sprintf("https://www.themoviedb.org/movie/%s", $MovieData->id);
        $Record->VoteAverage = $MovieData->vote_average;
        $Record->VoteCount = $MovieData->vote_count;
        $Record->Genres = $MovieData->genres;
        $Record->Directors = self::parseDirectorsfMovie($Credits);

        return $Record;
    }
    
    /**
     * 
     * @param type $Credits TMDB credit result json->stdclass (direcot, actor, etc)
     * @return type array of director IDs
     */
    
    public static function parseDirectorsfMovie($Credits) {
        $Directors = array();
        foreach ($Credits->crew as $Crew) {
            //print_r($Crew);exit;
            if ($Crew->job != 'Director') {
                continue;
            }
            $Directors[] = $Crew->id;
        }
        return $Directors;
    }

}
