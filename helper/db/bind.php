<?php

namespace helper\db;

class bind {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function Replace($Query, $Bind) {
        if (!is_array($Bind)) {
            $Bind = array($Bind);
        }
        $Delimiter = ':';
        foreach ($Bind as $Key => $pv) {  //change delimiter eg. $Bind = array($Param,'delimiter'=>'@');
            if (strcmp($Key, 'delimiter') === 0) {
                $Delimiter = $pv;
                unset($Bind[$Key]);  //remove delimiter row from bind array 
            }
        }
        $Bind2 = array_reverse($Bind);
        $Index = count($Bind2);
        foreach ($Bind2 as $Key => $pv) {
            if (!$Key || is_numeric($Key)) {
                $Key = $Index;
            }
            $Rnd = '===' . $Index . '===' . substr(md5(rand()), 0, 8) . '===' . $Index . '===';
            $BindR[$Rnd] = $pv;
            $Query = str_replace($Delimiter . $Key, $Rnd, $Query);
            $Index--;
        }
        $Query = str_replace('##', \config\data::DB_PREFIX, $Query);
        foreach ($BindR as $Key => $pv) {
            if (strtoupper($pv) == 'NULL' && is_string($pv)) {
                $Query = str_replace($Key, 'NULL', $Query);
            } else {
                $Query = str_replace($Key, "'" . $this->db->escape($pv) . "'", $Query);
            }
        }
        return $Query;
    }

}