<?php
require_once 'helper/functions.php';

//build registry pattern
$Registry->set('db', $Db);
$Registry->set('log', new helper\Log('log/movies.log'));
$Registry->set('console', new helper\console());

//Download 20 records of TMDB 
$TopRated = new \movies\toprated($Registry, new loaders\toprated($Registry), new \saver\toprated($Registry));
$TopRated->load();

//Download movies
$MoviesSpool = new movies\movies($Registry, new loaders\movies($Registry), new saver\movie($Registry));
$MoviesSpool->load();

//download directors
$DirectorSpool = new movies\directors($Registry, new loaders\directors($Registry), new saver\directors($Registry));
$DirectorSpool->load();

$Spool = new saver\spool($Registry);  //when the spool is full, it moves the records new->actual
$Spool->finish();
