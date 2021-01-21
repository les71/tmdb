<?php

namespace loaders;

/*
 * Toldylaszlo.hu
 * 2021
  TMDB loader



  /**
 * Download pre selected movies records from TMDB
 * toprated class pre loaded movie ID
 *
 * @author tl
 */

class movies extends \helper\Controller {


    public function load() {
        
        $Movies=array();
        $Spool = $this->loadSpool();
        foreach ($Spool as $Movie) {
            $Movies[] = $this->downloadMovieDataFromTMDB($Movie['tmdb_id']);
        }
        return $Movies;
    }

    private function downloadMovieDataFromTMDB($MovieId) {
        $MovieDetails = \helper\tmdbloader::loadTMDBData(sprintf('movie/%d', $MovieId));
        $Credits = \helper\tmdbloader::loadTMDBData(sprintf('movie/%d/credits', $MovieId));
        return \record\movie::parse($MovieDetails, $Credits);
    }

    protected function loadSpool() {
        $SQL = "SELECT `tmdb_id` FROM `movies` WHERE `isdownload`=1 LIMIT 20";
        return $this->db->execute($SQL, NULL, \helper\db\query::RETURN_ROWS);
    }

}
