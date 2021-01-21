<?php

namespace saver;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace saver;

  /**
 * Save movie's ID in spool to download
 *
 * @author tl
 */

class toprated extends isaver {

    public function saveRecord($Record) {
        $this->insertMovieToMovies($Record);
        $this->insertMovieToSpool($Record);
    }

    private function insertMovieToSpool($Record) {
        //print_r($MovieData);
        $SQL = "INSERT INTO `top_rated` (`movie_id`,`new_place`,`created_at`,`updated_at`) 
                VALUES (:1,:2,NOW(),NOW())
                ON DUPLICATE KEY UPDATE `new_place`=:2";
        $Bind = array($Record->Id, $Record->Place);
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

    private function insertMovieToMovies($Record) {
        $SQL = "INSERT INTO `movies` (`tmdb_id`, `title`, `length`, `release date`, `overview`, `poster url`, `vote average`, `vote count`, `tmdb url`, `created_at`, `updated_at`, `isdownload`, `valid`)
                VALUES (:1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', NULL)
                ON DUPLICATE KEY UPDATE `vote average`=:2, `vote count`=:3;";
        $Bind = array($Record->Id, $Record->VoteAverage, $Record->VoteCount);
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

}
