<?php

namespace loaders;

/*
 * Toldylaszlo.hu
 * 2021{licensePrefix}
  TMDB loader

  namespace loaders;

  /**
 * Download top rated movie records from TMDB by API
 * One query contanains 20 records
 *
 * @author tl
 */

class toprated extends \helper\Controller {

    private $Movies = array();

    public function load() {

        $PageNum = $this->getStartPageNum();
        if ($PageNum == 0) {
            return array(); //if count of record>210
        }
        $this->loadPageFromTMDBA($PageNum);
        return $this->Movies;
    }

    private function loadPageFromTMDBA($pageNum) {
        $Movies = \helper\tmdbloader::loadTMDBData('movie/top_rated', sprintf('page=%s', $pageNum));

        $Counter = 1;
        foreach ($Movies->results as $MovieData) {
            $Place = ($pageNum - 1) * \config\data::COUNT_OF_RECORDS_IN_ONE_PAGE + $Counter;
            $TopRatedRecord = \record\toprated::parse($MovieData, $Place);
            $this->Movies[] = $TopRatedRecord;
            $this->log->write(sprintf('Ok toprated id:%s title:%s place:%s', $TopRatedRecord->Id, $TopRatedRecord->Title, $Place));
            if($Place== \config\data::MAX_NUMBER_OF_RECORDS){
                break;
            }
            $Counter++;
        }
    }

    protected function getStartPageNum() {
        $SQL = "SELECT MAX(`new_place`) as 'max' FROM `top_rated`";
        $MaxPlace = $this->db->execute($SQL, NULL, \helper\db\query::RETURN_FIELD, 'max');
        if ($MaxPlace > \config\data::MAX_NUMBER_OF_RECORDS) {
            return 0;
        }
        if (!$MaxPlace) {
            return 1;
        }
        return floor($MaxPlace / \config\data::COUNT_OF_RECORDS_IN_ONE_PAGE) + 1; //count of records(20) in one query on TMBD
    }

}
