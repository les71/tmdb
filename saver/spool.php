<?php

namespace saver;

/*
 * Toldylaszlo.hu
 * 2021
  TMDB loader



  /**
 * when the spool is full, it moves the records new->actual 
 *
 * @author tl
 */

class spool extends \helper\Controller {

    public function finish() {
        $SQL = "SELECT MAX(`new_place`) as 'max' FROM `top_rated`";
        $MaxPlace = $this->db->execute($SQL, NULL, \helper\db\query::RETURN_FIELD, 'max');
        if ($MaxPlace < \config\data::MAX_NUMBER_OF_RECORDS) {
            return false;
        }
        $this->UpdateTopRecord();
    }

    private function UpdateTopRecord() {
        $SQLClear = "UPDATE `top_rated` SET `actual_place`=NULL,`updated_at`=NOW()";
        $this->db->execute($SQLClear, NULL, \helper\db\query::RETURN_LAST_ID);

        $SQLUpdate = "UPDATE `top_rated` SET `actual_place`=`new_place`,`updated_at`=NOW()";
        $this->db->execute($SQLUpdate, NULL, \helper\db\query::RETURN_LAST_ID);

        $SQLInit = "UPDATE `top_rated` SET `new_place`=NULL,`updated_at`=NOW()";
        $this->db->execute($SQLInit, NULL, \helper\db\query::RETURN_LAST_ID);
    }

}
