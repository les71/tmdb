<?php

namespace helper\db;

class query {

    const RETURN_ROWS = 1;
    const RETURN_ROW = 2;
    const RETURN_AFFECTED_ROW = 3;
    const RETURN_LAST_ID = 4;
    const RETURN_FIELD = 5;
    const RETURN_QUERY = 6;
    const RETURN_RESULT = 7;
    const RETURN_NONE = 8;

    private $db;
    private $bind;

    public function __construct($db, $Bind) {
        $this->db = $db;
        $this->bind = $Bind;
    }
    
    public function escapeValue($Value) {
        return $this->db->escape($Value);
    }
    
    public function execute($Query, $Bind = FALSE, $ReturnMode = self::RETURN_ROWS, $Field = '') {
        $FormatedQuery = $this->bind->Replace($Query, $Bind);
        //echo $FormatedQuery;
        $Result = $this->db->query($FormatedQuery);
        switch ($ReturnMode) {
            case self::RETURN_ROWS:
                return $Result->rows;
            case self::RETURN_ROW:
                return $Result->row;
            case self::RETURN_FIELD:
                if (!$Result->row) {
                    return FALSE;
                }
                return $Result->row[$Field];
            case self::RETURN_AFFECTED_ROW:
                return $this->db->countAffected();
            case self::RETURN_QUERY:
                return $FormatedQuery;
            case self::RETURN_RESULT:
                return $Result;
            case self::RETURN_LAST_ID:
                return $this->db->getLastId();
        }
    }

}