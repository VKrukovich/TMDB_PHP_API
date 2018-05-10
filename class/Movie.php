<?php

class Movie{

	private $_data;

	public function __construct($data) {
		$this->_data = $data;
	}

	public function getID() {
		return $this->_data['id'];
	}

	public function getTitle() {
		return $this->_data['title'];
	}

    public function getOriginalTitle() {
        return $this->_data['original_title'];
    }

    public function getOverview() {
        return $this->_data['overview'];
    }

    public function getReleaseDate() {
        return $this->_data['release_date'];
    }

	public function getPoster() {
		return $this->_data['poster_path'];
	}

	public function getJSON() {
		return json_encode($this->_data, JSON_PRETTY_PRINT);
	}


}
