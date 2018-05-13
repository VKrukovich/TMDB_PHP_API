<?php
include("Movie.php");
include("Class.MovieDetails.inc");

class TMDB{

	const API_URL = "http://api.themoviedb.org/3/";
	private $_apikey;
	private $_lang;
	private $_config;
	private $_debug;


	public function __construct($apikey, $lang = 'en', $debug = false) {
		$this->setApikey($apikey);
		$this->setLang($lang);
		$this->_debug = $debug;
		if (! $this->_loadConfig()){
			echo "Unable to read configuration, verify that the API key is valid";
			exit;
		}
	}
	private function setApikey($apikey) {
		$this->_apikey = (string) $apikey;
	}

	private function getApikey() {
		return $this->_apikey;
	}

	public function setLang($lang = 'en') {
		$this->_lang = $lang;
	}

	public function getLang() {
		return $this->_lang;
	}

	private function _loadConfig() {
		$this->_config = $this->_call('configuration', '');

		return ! empty($this->_config);
	}

	public function getConfig(){
		return $this->_config;
	}

	public function getImageURL($size = 'original') {
		return $this->_config['images']['base_url'] . $size;
	}


	public function getNowPlayingMovies ($page = 1) {

		$movies = array();

		$result = $this->_call('movie/now_playing', '&page='. $page);

			for ($page = 1; $page <= $result['total_pages']; $page++) {
			$result = $this->_call('movie/now_playing', '&page='. $page);

			foreach($result['results'] as $data){
				$movies[] = new MovieDetails($data);

			}

		}
		return $movies;
	}

	public function getDetails ($id_movie){
		$movies_details = array();
		$results  = $this->_call_id('movie/'.$id_movie);
		echo '<pre>'; print_r($results); echo '</pre>';

		foreach($results as $result){
			$movies_details[] = new MovieDetails($result);
			echo '<pre>'; print_r($movies_details); echo '</pre>';

			}

		return $movies_details;

		}



	private function _call($action, $appendToResponse){

		$url = self::API_URL.$action .'?api_key='. $this->getApikey() .'&language='. $this->getLang() .'&'.$appendToResponse;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);

		$results = curl_exec($ch);

		curl_close($ch);

		return (array) json_decode(($results), true);


}

private function _call_id($id_movie){

	$url = self::API_URL.$id_movie.'?api_key='. $this->getApikey() .'&language=ru&region=ru';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);

	$results = curl_exec($ch);

	curl_close($ch);

	return (array) json_decode(($results), true);

}
}
?>
