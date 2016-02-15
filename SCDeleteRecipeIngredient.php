<html>
<body>
<?php
include('SCEditRecipe.php');
if(isset($_GET['RecIngID']) && isset($_GET['RecipeID']))
{
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
	
	$RecIngID=$_GET['RecIngID'];
	$RecipeID=$_GET['RecipeID'];
	
	$sql = "DELETE from RECIPEINGREDIENTS WHERE RecIngID='$RecIngID'";
	$result = $conn->query($sql);

	if($result)
	{
		header('location:SCEditRecipe.php?RecipeID='.$RecipeID);
	}
	$conn->close();
}
?>
</body>
</html>