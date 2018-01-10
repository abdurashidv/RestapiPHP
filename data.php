<?php

function connect(){
	try {
		pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=rashid");
	}catch (Exception $e) {
		die("Error in connection: " . pg_last_error());
	}
}

function getList($userid)
{
	connect();

	$query = "SELECT id, name, recipe FROM catalogs WHERE userid = '$userid' ";
	$result = pg_fetch_all(pg_query($query));

	if ($result != 'FALSE') {
		return $result;
	}

	return;
}

function getRecipe($id)
{
	connect();

	$query = "SELECT id, name, recipe FROM catalogs WHERE id = '$id' ";
	$result = pg_fetch_all(pg_query($query));

	if ($result != 'FALSE') {
		return $result;
	}

	return 'Bad';
}

function editRecipe($name, $recipe, $catalogID)
{
	connect();

	$query = "UPDATE catalogs SET name = '$name', recipe = '$recipe' WHERE id = '$catalogID'";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function createRecipe($name, $recipe, $userID)
{
	connect();

	$query = "INSERT INTO catalogs(name, recipe, userid) VALUES ('$name','$recipe','$userID')";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function deleteRecipe($id)
{
	connect();

	$query = "DELETE FROM catalogs WHERE id = $id";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function checkUser($login, $password)
{
	connect();

	$query = "SELECT id FROM users WHERE login = '$login' AND password = '$password'";
	$result = pg_fetch_all(pg_query($query));

	if ($result != 'FALSE') {
		return $result;
	}

	return 'fail';
}

function createUser($firstname, $lastname, $login, $password)
{
	connect();

	$query = "INSERT INTO users(firstname, lastname, login, password) VALUES('$firstname','$lastname','$login','$password')";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return 'success';
	}

	return 'fail';
}

?>
