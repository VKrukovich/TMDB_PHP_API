<?php

class Movie {
	private $_data;
	public $id;
	public $title;
	public $original_title;
	public $overview;
	public $release_date;
	public $poster_path;
	public $runtime;
	public $genres;


	public function __construct($data) {
		$this->id = $data['id'];
		$this->title = $data['title'];
		$this->original_title = $data['original_title'];
		$this->overview = $data['overview'];
		$this->release_date = $data['release_date'];
		$this->poster_path = $data['poster_path'];
		$this->runtime = '';
		$this->genres = '';
		}

	public function checkId (){
		$timeRangeStart = date("Y-m-d",strtotime("-7 days"));
		$timeRangeStop = date("Y-m-d");
		if ($this->release_date >= $timeRangeStart and $this->release_date <= $timeRangeStop){
			return $this->id;
		}}


	public function displayDetails (){
		echo '<h3>' . $this->original_title . '</h3>';
		echo '<p>' . $this->title . '</p>';
		echo '<p>Обзор : ' . $this->overview . '</p>';
		echo '<p>Дата выхода : ' . $rel = date('d F Y', strtotime($this->release_date)). '</p>';
		echo '<p>Продолжительность : ' . $this->runtime . ' мин' .'</p>';
		foreach($this->genres as $g){
			echo '<span> ' . $g['name'] . '</span>';
		}

	}


	public function getJSON() {
		return json_encode($this->_data, JSON_PRETTY_PRINT);
	}

}

