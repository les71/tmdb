<?php

namespace loaders;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader



  /**
 * Download pre selected director records from TMDB
 * Movies class pre loaded director ID
 *
 * @author tl
 */

class directors extends \helper\Controller {

    public function load() {

        $Directors = array();
        $Spool = $this->loadSpool();
        foreach ($Spool as $Director) {
            $Directors[] = $this->downloadDirectorDataFromTMDB($Director['id']);
        }
        return $Directors;
    }

    private function downloadDirectorDataFromTMDB($DirectorId) {
        $PersonDetails = \helper\tmdbloader::loadTMDBData(sprintf('person/%d', $DirectorId));
        $Person=\record\director::parse($PersonDetails);
        $this->log->write(sprintf('Ok director id:%s name:%s', $Person->Id, $Person->Name));
        return $Person;
    }

    protected function loadSpool() {
        $SQL = "SELECT `id` FROM `directors` WHERE `isdownload`=1 LIMIT 20";
        return $this->db->execute($SQL, NULL, \helper\db\query::RETURN_ROWS);
    }

}
