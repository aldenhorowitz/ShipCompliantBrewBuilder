<html>
<body>
<?php
include('SCBeerRecipe.php');
if(isset($_GET['RecipeID']))
{
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
	
	$RecipeID=$_GET['RecipeID'];
	$sql = "DELETE from RECIPES WHERE RecipeID='$RecipeID'";
	$result = $conn->query($sql);
	// TODO foreign keys and cascade deletes/updates
	$sqlCascade = "DELTE from RECIPEINGREDIENTS WHERE RecipeID='$RecipeID'";
	$resuleCascade = $conn->query($sql);

	if($result)
	{
		header('location:SCBeerRecipe.php');
	}
	$conn->close();
}
?>
</body>
</html>