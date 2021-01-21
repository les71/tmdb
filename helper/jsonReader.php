<?php

namespace helper;

class jsonReader {

    public static function loadDataFromRemote($URL, $Username = FALSE, $Password = FALSE) {
        $ch = curl_init();
        $timeout = 20;

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($Username) {
            curl_setopt($ch, CURLOPT_USERPWD, $Username . ":" . $Password);
        }
        $data = curl_exec($ch);
        if (curl_error($ch)) {
            echo curl_error($ch);
        }
        curl_close($ch);

        
        //print_r($data);
        return json_decode($data);
    }

}
