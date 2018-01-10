<?php

require "connect.php";

function getList($userid)
{
	connect();

	$query = "SELECT id, name, recipe, image FROM catalogs WHERE userid = '$userid' ";
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

function editRecipe($name, $recipe, $catalogID): boolean
{
	connect();

	$query = "UPDATE catalogs SET name = '$name', recipe = '$recipe' WHERE id = '$catalogID'";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function createRecipe($name, $recipe, $image, $userID): boolean
{
	connect();

	$query = "INSERT INTO catalogs(name, recipe, image, userid) VALUES ('$name','$recipe', '$image','$userID')";
	$result = pg_query($query);

	if ($result != 'FALSE') {
		return true;
	}

	return false;
}

function deleteRecipe($id): boolean
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

	return null;
}

function createUser($firstname, $lastname, $login, $password): string
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
