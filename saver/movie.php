<?php

namespace saver;

/*
 * Toldylaszlo.hu
 * 2021
  TMDB loader

  namespace saver;

  /**
 * save details of movie, genres, directors
 * it saves relations of movie and genre and director. Also save director's id from download
 *
 * @author tl
 */

class movie extends isaver {

    public function saveRecord($Record) {
        //print_r($Record);
        $this->updateMovieRecord($Record);
        $this->insertGenres($Record->Genres, $Record->Id);
        $this->insertDirectors($Record->Directors, $Record->Id);
    }

    public function updateMovieRecord($Record) {
        $SQL = "UPDATE `movies` SET `title` = @1, `length` = @2, `release date` = @3, `overview` = @4, `poster url` = @5, `tmdb url` = @6,`vote average`=@7, `vote count`=@8,
                `updated_at` = NOW(), `valid` = 'yes', isdownload=NULL WHERE `tmdb_id` =@9 LIMIT 1";

        $Bind = array($Record->Title, $Record->Length, $Record->ReleaseDate, $Record->Overview, $Record->PosterUrl, $Record->TmdbUrl, $Record->VoteAverage, $Record->VoteCount, $Record->Id, 'delimiter' => '@');
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

    private function insertGenres($Genres, $MovieId) {
        foreach ($Genres as $Genre) {
            $this->insertGenre($Genre);
            $this->insertGenreToMovie($MovieId, $Genre->id);
        }
    }

    private function insertGenre($Genre) {
        $SQL = "INSERT IGNORE INTO `genres` (`id`, `name`, `created_at`, `updated_at`, `valid`) VALUES (:1, :2, NOW(), NOW(), 'yes');";
        $Bind = array($Genre->id, $Genre->name);
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

    private function insertGenreToMovie($MovieId, $GenreId) {
        $SQL = "INSERT IGNORE INTO `movie_to_genre` (`movie_id`, `genre_id`, `created_at`, `updated_at`, `valid`) VALUES (:1, :2, NOW(), NOW(), 'yes');";
        $Bind = array($MovieId, $GenreId);
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

    private function insertDirectors($Directors, $MovieId) {
        foreach ($Directors as $DirectorId) {
            $this->insertDirector($DirectorId);
            $this->insertDirectorToMovie($DirectorId, $MovieId);
        }
    }

    private function insertDirector($DirectorId) {
        $SQL = "INSERT IGNORE INTO `directors` (`id`, `name`, `biography`, `date of birth`, `created_at`, `updated_at`, `isdownload`, `valid`) 
                VALUES (:1, NULL, NULL, NULL, NOW(), NULL, 'yes', NULL);";
        $Bind = array($DirectorId);
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

    private function insertDirectorToMovie($Director, $MovieId) {
        $SQL = "INSERT IGNORE INTO `movie_to_director` (`movie_id`, `director_id`, `created_at`, `updated_at`, `valid`) VALUES (:1, :2, NOW(), NOW(), 'yes');";
        $Bind = array($MovieId, $Director);
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

}
