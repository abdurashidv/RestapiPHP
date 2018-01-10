<?php
session_start();

function processData($url){
	$client = curl_init($url);
   	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
   	$response = curl_exec($client);

   	return json_decode($response);
}

//variable initialization
$output = "";
$name = "";
$recipe = "";
$pButton = "";
$row="";

//default veriables
$hostname = "http://$_SERVER[HTTP_HOST]";
$catalogStyle = "style='display:block;'";
$processStyle = "style='display:none;'";

//USER CHECK
// If user is logged in continue on this page else send to login page
$login = $_SESSION['user']['login'];
$password = $_SESSION['user']['password'];

$url = $hostname."/CatalogApi/api/login/".$login."/".$password;
$result = processData($url);

$data = get_object_vars($result->data[0]);
$uid = $data['id'];

if($result->data == 'fail'){
	header("Location: ".$hostname."/CatalogApi/index.php");
}
//END OF USER CHECK

	if(isset($_GET['process'])){
		if($_GET['process'] == 'create'){
			//styles
			$pButton = 'CREATE';
			$catalogStyle = "style='display:none;'";
			$processStyle = "style='display:block;'";

			//query
			
			if(isset($_POST['CREATE'])){
				$name = str_replace(" ","+",$_POST['name']);
				$recipe = str_replace(" ","+",$_POST['recipe']);
				$uid = 1;

				$url = $hostname."/CatalogApi/api/create/".$name."/".$recipe."/".$uid;
				$result = processData($url);

				header("Location: ".$hostname."/CatalogApi/catalog.php");
			}

		} else if($_GET['process'] == 'edit') {
			//styles
			$pButton = 'UPDATE';
			$catalogStyle = "style='display:none;'";
			$processStyle = "style='display:block;'";
			$pShow = "style='display:block;'";

			//query
			if(isset($_POST['UPDATE'])){
				$name = str_replace(" ","+",$_POST['name']);
				$recipe = str_replace(" ","+",$_POST['recipe']);
				$id = $_GET['id'];

				$url = $hostname."/CatalogApi/api/edit/".$name."/".$recipe."/".$id;
				$result = processData($url);

				echo $name;
				echo "<br>";
				echo $recipe;

				header("Location: ".$hostname."/CatalogApi/catalog.php");
			} else {
				$id = $_GET['id'];
				$url = $hostname."/CatalogApi/api/recipe/".$id;
				$result = processData($url);
				$row = get_object_vars($result->data[0]);

				$name = $row['name'];
				$recipe = $row['recipe'];
			}
		} else if($_GET['process'] == 'delete') {
			$id = $_GET['id'];
			$url = "http://localhost/CatalogApi/api/delete/" . $id;
			$result = processData($url);
			header("Location: ".$hostname."/CatalogApi/catalog.php");
		}
	} else {
		$url = $hostname."/CatalogApi/api/list/".$uid;
		$result = processData($url);

		if(sizeof($result->data) > 0 ){
			foreach($result->data as $data){
      			$row = get_object_vars($data);
      			$output .= "<tr><td>" . $row['id'] . "</td>";
      			$output .= 		"<td>". $row['name']."</td>";
      			$output .= 		"<td>".$row['recipe']."</td>";
      			$output .= "<td><a href='./edit/" . $row['id'] . "'>Edit</a> / <a href='./delete/" . $row['id'] . "'>Delete</a></td></tr>";
    		}
		} else {
			$output .= "<tr><td>No Data</td><td>No Data</td><td>No Data</td><td></td></tr";
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Catalog</title>
	<link href="http://localhost/CatalogApi/styles/bootstrap.min.css" rel="stylesheet">
	<link href="http://localhost/CatalogApi/styles/main.css" rel="stylesheet">
</head>
<body>
<div class="contianer content">
	
	<!-- List of Recipes By user id -->
	<div <?php echo $catalogStyle; ?>>
		<div class="row">
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-8 col-sm-8">
				<div class="pull-right"><a href='./create'>Create New Catalog</a></div>
			</div>
			<div class="col-md-2 col-sm-2"></div>
		</div>
	
		<div class="row">
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-8 col-sm-8">
				<table class="table table-striped">
    				<thead>
        				<tr>
            				<th>Row</th>
            				<th>Name</th>
            				<th>Recipe</th>
            				<th></th>
        				</tr>
    				</thead>
					<tbody>
						<?php echo $output; ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-2 col-sm-2"></div>
		</div>
	</div>

	<!-- Edit	 -->
	<div <?php echo $processStyle; ?>>
		<div class="row">
        	<div class="col-md-3 col-sm-3"></div>
        	<div class="col-md-6 col-sm-6"><b>Catalog</b></div>
        	<div class="col-md-3 col-sm-3"></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-3 col-sm-3"></div>
        	<div class="col-md-6 col-sm-6">
            	<form action="" method="post">
                	<div class="form-row">
                    	<div class="col">
                        	<input name="name" type="text" class="form-control" placeholder="Name" value="<?php echo $name; ?>">
                    	</div>
                    	<div class="col">
                        	<textarea name="recipe" class="form-control" placeholder="Recipe" cols="30" rows="4"><?php echo $recipe; ?></textarea>
                    	</div>
                    	<div class="col">
                        	<button name="<?php echo $pButton?>" type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $pButton?></button>
                    	</div>
                	</div>
            	</form>
        	</div>
        	<div class="col-md-3 col-sm-3"></div>
    	</div>
	</div>
</div>
</body>
</html>