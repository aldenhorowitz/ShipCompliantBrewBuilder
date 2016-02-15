<html>
<body>
<?php
include('SCIngredients.php');
if(isset($_GET['IngredientID']))
{
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
	
	$IngredientID=$_GET['IngredientID'];
	
	$sqlVerifyUnused = "SELECT RecIngID FROM RECIPEINGREDIENTS WHERE IngredientID ='$IngredientID'";
	$resultVerify = $conn->query($sqlVerifyUnused);
	if ($resultVerify->num_rows > 0)
	{
		echo 'Ingredient cannot be deleted becuase it is used by existing recipes.';
	}
	else
	{	
		$sql = "DELETE from INGREDIENTS WHERE IngredientID='$IngredientID'";
		$result = $conn->query($sql);

		if($result)
		{
			header('location:SCIngredients.php');
		}
	}
	$conn->close();
}
?>
</body>
</html>