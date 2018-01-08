<?php

$pButton = "";
$catalogStyle = "style='display:block;'";
$processStyle = "style='display:none;'";


	if(isset($_GET['process'])){
		if($_GET['process'] == 'create'){
			//styles
			$pButton = 'CREATE';
			$catalogStyle = "style='display:none;'";
			$processStyle = "style='display:block;'";

			//query
		} else if($_GET['process'] == 'edit') {
			//styles
			$pButton = 'UPDATE';
			$catalogStyle = "style='display:none;'";
			$processStyle = "style='display:block;'";
			$pShow = "style='display:block;'";

			//query
		} else if($_GET['process'] == 'delete') {
			//styles
			$pShow = "style='display:block;'";

			//query
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Catalog</title>
	<link href="./styles/bootstrap.min.css" rel="stylesheet">
	<link href="./styles/main.css" rel="stylesheet">
</head>
<body>
<div class="contianer content">
	
	<!-- List of Recipes By user id -->
	<div <?php echo $catalogStyle; ?>>
		<div class="row">
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-8 col-sm-8">
				<div class="pull-right"><a href='catalog.php?process=create'>Create New Catalog</a></div>
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
						<tr>
							<td>1</td>
							<td>Qurutob</td>
							<td>Chaka, Ob, Kabuti</td>
							<td><a href="catalog.php?process=edit">Edit</a> / <a href="catalog.php?process=delete">Delete</a></td>
						</tr>
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
        	<div class="col-md-6 col-sm-6"><b>Edit Catalog</b></div>
        	<div class="col-md-3 col-sm-3"></div>
    	</div>
    	<div class="row">
    	    <div class="col-md-3 col-sm-3"></div>
        	<div class="col-md-6 col-sm-6">
            	<form action="" method="post">
                	<div class="form-row">
                    	<div class="col">
                        	<input name="name" type="text" class="form-control" placeholder="Name">
                    	</div>
                    	<div class="col">
                        	<textarea name="recipe" class="form-control" placeholder="Recipe" cols="30" rows="4"></textarea>
                    	</div>
                    	<div class="col">
                        	<button name="edit" type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $pButton?></button>
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