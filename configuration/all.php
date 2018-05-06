<?php

//------------------------------------------------------------------------------
// Configuration to get all data
//------------------------------------------------------------------------------

// Global Configuration
$cnf['apikey'] = '';
$cnf['lang'] = 'en';
$cnf['timezone'] = 'Europe/Minsk';
$cnf['adult'] = false;
$cnf['debug'] = false;

// Data Return Configuration - Manipulate if you want to tune your results
$cnf['appender']['movie'] = array('account_states', 'alternative_titles', 'credits', 'images','keywords', 'release_dates', 'videos', 'translations', 'similar', 'reviews', 'lists', 'changes', 'rating');

?>