<?php

class MovieDetails extends Movie {
	public function displayDetails(){

	echo '<tt><pre>' . var_export($this, TRUE) . '</pre></tt>';
	}

}