<?php

function getList($userid)
{
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}

	$query = "SELECT id, name, recipe FROM catalogs WHERE userid = '$userid' ";
	$result = pg_fetch_all(pg_query($query));

	if ($result != 'FALSE') {
		return $result;
	}

	return;
}

function getRecipe($id)
{
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}

	$query = "SELECT id, name, recipe FROM catalogs WHERE id = '$id' ";
	$result = pg_fetch_all(pg_query($query));

	if ($result != 'FALSE') {
		return $result;
	}

	return 'Bad';
}

function editRecipe($name, $recipe, $catalogID)
{
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}

	$query = "UPDATE catalogs SET name = '$name', recipe = '$recipe' WHERE id = '$catalogID'";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function createRecipe($name, $recipe, $userID)
{
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}

	$query = "INSERT INTO catalogs(name, recipe, userid) VALUES ('$name','$recipe','$userID')";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function deleteRecipe($id)
{
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}

	$query = "DELETE FROM catalogs WHERE id = $id";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

?>
