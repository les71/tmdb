<?php

namespace helper;

class Log {

    private $File;

    public function __construct($File) {
        $this->File = $File;
    }

    public function write($Message, $DateTime = false) {
        if (!$fp = @fopen($this->File, "a")) {
            return FALSE;
        }

        if (!$DateTime) {
            $DateTime = date("Y-m-d  H:i:s");
        }

        $Message = $DateTime . "\t" . $Message . "\n";

        fwrite($fp, $Message);
        fclose($fp);
    }

}
