<?php

namespace helper;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace helper;

  /**
 * Description of tmdbloader
 *
 * @author tl
 */

class tmdbloader extends jsonReader{

    public static function loadTMDBData($RestFunction, $Data = '') {
        $URL = sprintf("https://api.themoviedb.org/3/%s?api_key=%s&%s", $RestFunction, \config\data::APIKEY, $Data);
        return self::loadDataFromRemote($URL);
    }

}
