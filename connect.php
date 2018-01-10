<?php

function connect(){
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}
}