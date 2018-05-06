<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include "conf/info.php";
$apikey = "";

?>


<?php
// define the path and name of cached file
$cachefile = 'cached_files/cache'.'.php';
// define how long we want to keep the file in seconds. I set mine to 5 hours.
$cachetime = 18000;
// Check if the cached file is still fresh. If it is, serve it up and exit.
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    include($cachefile);
    exit;
}
// if there is either no file OR the file to too old, render the page and capture the HTML.
ob_start();
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TMDB PHP API</title>

        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Inline CSS -->
        <style type="text/css">
            body {
                background-color: #F1F1F1;
            }

            #main-container {
                background-color: #F1F1F1;
                min-height: 550px;
                padding-top: 60px;
            }

            #page-title {
                margin-top: 0px;
            }

            img {max-width:100%
            }
        </style>
    </head>
    <body>

        <!-- NavBar -->

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="navbar-brand">TMDB PHP API</span>
                </div>


                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Query mode</a>
                        </li>
                        <li>
                            <a href="render-php-file.php">List mode</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Container -->








    <ul>
        <?php
        include_once "api/api_now.php";
        $min = date('d F Y', strtotime("-7 days"));
        $time_range_start = date("Y-m-d",strtotime("-7 days"));
        $max = date('d F Y');
        $time_range_stop = date("Y-m-d");
        echo "<h5><sub>from</sub> <span>". $min . "</span> , <sub>until</sub> <span>" . $max . "</span></h5>";
        ?>

        <hr>

        <?php



        foreach($nowplaying->results as $p){
            //echo $p->release_date;
            if($p->release_date >= $time_range_start and $p->release_date <= $time_range_stop) {
                // echo '<li><img src="'.$imgurl_1.''. $p->poster_path . '"><h4>' . $p->original_title . '<li>'. '<h4>'. '<p> Overview: '. $p->overview . '</p>'. '<p> Release Date: '. $rel = date('d F Y', strtotime($p->release_date)).//" </h4></li>";
                // '<p> Runtime: '. $p->runtime . '</p>'. '<p> Genres list: '. $p->id . '</p>'." </h4></li>";
                $id_movie = $p->id;


                //$object_vars = get_object_vars($p);

                //foreach ($object_vars as $name => $value) {
                //echo "$name : $value\n";}





                if ($id_movie) {
                    include "api/api_movie_id.php";
                    ?>
                    <h3><?php echo $movie_id->title ?></h3>

                    <h3><?php echo $p->title ?></h3>
                    <hr>
                    <img src="<?php echo $imgurl_2 ?><?php echo $movie_id->poster_path ?>">
                    <p>Overview : <?php echo $movie_id->overview ?></p>
                    <p>Release Date : <?php $rel = date('d F Y', strtotime($movie_id->release_date)); echo $rel ?>
                    <p>Runtime : <?php echo $movie_id->runtime.' min' ?></p>
                        <p>Genres list:
                    <?php

                    foreach($movie_id->genres as $g){
                        echo '<span>' . $g->name . '</span> ';
                    }
                } }}
        ?>

    </p>
        <hr>


    </ul>





    </body>
</html>

<!-- Bootstrap JS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



<?php
// We're done! Save the cached content to a file
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
// finally send browser output
ob_end_flush();
?>
