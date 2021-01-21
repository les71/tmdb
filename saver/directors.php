<?php

namespace saver;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace saver;

  /**
 * save details of director
 *
 * @author tl
 */

class directors extends isaver {

    /**
     * 
     * @param type $Record record\director record
     */
    
    public function saveRecord($Record) {
        $SQL = "UPDATE `directors` SET `name` = @1, `biography` = @2, `date of birth` = @3, `updated_at` = NOW(), `isdownload` = NULL, `valid` = 'yes' WHERE `id` = @4 LIMIT 1;";
        $Bind = array($Record->Name, $Record->Biography, $Record->DateOfBirth, $Record->Id, 'delimiter' => '@');
        //echo $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_QUERY);exit;
        $this->db->execute($SQL, $Bind, \helper\db\query::RETURN_LAST_ID);
    }

}
