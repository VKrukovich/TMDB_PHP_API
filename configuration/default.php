<?php

//------------------------------------------------------------------------------
// Default Configuration
//------------------------------------------------------------------------------

// Global Configuration
$cnf['apikey'] = '';
$cnf['lang'] = 'en';
$cnf['timezone'] = 'Europe/Minsk';
$cnf['adult'] = false;
$cnf['debug'] = false;

// Data Return Configuration - Manipulate if you want to tune your results
$cnf['appender']['movie'] = array('trailers', 'images', 'credits', 'translations', 'reviews');

?>