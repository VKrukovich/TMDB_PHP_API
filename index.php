<?php
$cachefile = 'cache/cache'.'.php';
$cachetime = 18000;
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
	include($cachefile);
	exit;
}
ob_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include ('class/tmdb-api.php');
include('configuration/configuration.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TMDB PHP API</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="img/fav.jpg" type="image/x-icon">
		<!-- Bootstrap CSS  -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- CSS -->
		<link href="css/style.css" type="text/css" rel="stylesheet">
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
					 </button>
					<span class="navbar-brand">TMDB PHP API</span>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.php">Query mode</a>
						</li>
						<li>
							<a href="list.php">List mode</a>
						</li>
					</ul>
				</div>
		</nav>

		<ul>
		<?php
			echo '<h3>Now Playing Movies</h3>';
			$min = date('d F Y', strtotime("-7 days"));
			$timeRangeStart = date("Y-m-d",strtotime("-7 days"));
			$max = date('d F Y');
			$timeRangeStop = date("Y-m-d");
			echo "<h5><sub>from</sub> <span>". $min . "</span> , <sub>until</sub> <span>" . $max . "</span></h5>";
			$movies = $tmdb->getNowPlayingMovies();

			foreach ($movies as $movie){
				$checked_id = $movie->checkId();
				if ($checked_id){
					$extra_details = $tmdb->getDetails($checked_id);
					$movie->runtime = $extra_details['runtime'];
					$movie->genres = $extra_details['genres'];
					$movie->displayDetails();
					echo '<p><img src="' . $tmdb->getImageURL('w300') . $movie->poster_path . '"/></p>';

				}
			}

		?>
		</ul>
			<!-- Bootstrap JS -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>

<?php
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();
?>
