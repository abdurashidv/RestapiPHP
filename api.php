<?php 

header("Content-Type:application/json");
	
require "data.php";

$result = '';

if(!empty($_GET['process']))
{
	$process=$_GET['process'];

	if($process == 'list'){
		$userID = $_GET['uid'];
		$result = getList($userID);
	} else if($process == 'edit'){
		$name = $_GET['name'];
		$recipe = $_GET['recipe'];
		$catalogID = $_GET['id'];

		$result = editRecipe($name, $recipe, $catalogID);
	} else if($process == 'recipe'){
		$id = $_GET['id'];

		$result = getRecipe($id);
	} else if($process == 'create'){
		$name = $_GET['name'];
		$recipe = $_GET['recipe'];
		$userID = $_GET['uid'];
		$image = $_GET['image'];

		$result = createRecipe($name, $recipe, $image, $userID);
	} else if($process == 'delete'){
		$id = $_GET['id'];

		$result = deleteRecipe($id);
	} else if($process == 'login'){
		$login = $_GET['login'];
		$password = $_GET['password'];

		$result = checkUser($login, $password);
	} else if($process == 'signup'){
		$firstname = $_GET['firstname'];
		$lastname = $_GET['lastname'];
		$login = $_GET['login'];
		$password = $_GET['password'];

		$result = createUser($firstname, $lastname, $login, $password);
	}
	
	if(empty($result))
	{
		response(200,"Product Not Found",NULL);
	}
	else
	{
		response(200,"Product Found",$result);
	}

}
else
{
	response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$data)
{
	$response['status']			=	$status;
	$response['status_message']	=	$status_message;
	$response['data']			=	$data;

	$json_response				=	json_encode($response);
	echo $json_response;
}

?>