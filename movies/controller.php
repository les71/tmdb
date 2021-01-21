<?php

namespace movies;

/*
 * Toldylaszlo.hu
 * 2021
  TMDB loader



  /**
 * controller is the based class of movie parsers
 *
 * @author tl
 */

class controller extends \helper\Controller {

    protected $Loader;
    protected $Saver;

    public function __construct($registry, $Loader, $Saver) {
        parent::__construct($registry);
        $this->Loader = $Loader;
        $this->Saver = $Saver;
    }

    public function load() {
        $Records = $this->Loader->load();
        $this->Saver->save($Records);
    }

}
