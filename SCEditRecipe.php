<html>
<body>
<link rel="stylesheet" type="text/css" href="SCTable.css" />
<center>
<?php

if(isset($_GET['RecipeID']))
{
	$servername = "localhost";
	$username = "root";
	$password = "ShipCompliant";
	$dbname = "SCBeerRecipe";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) { die("Connection failed: " - $conn->connect_error);}

	// Select recipe and ingredients
	$RecipeID=$_GET['RecipeID'];

	$sqlRecipeName = "SELECT RecipeName from Recipes WHERE RecipeID ='$RecipeID'";
	$RecipeName = $conn->query($sqlRecipeName)->fetch_assoc()['RecipeName'];

	echo "<h1>" . $RecipeName . "</h1>";

	$sql = "SELECT ri.RecIngID, ri.RecipeID, ri.IngredientID, ri.Qty, ri.Comment, i.IngredientName, i.Unit FROM RecipeIngredients ri Join Ingredients i on i.IngredientID = ri.IngredientID WHERE ri.RecipeID = '$RecipeID'";
	$result = $conn->query($sql);

	// build table and output data of each row	
	if ($result->num_rows > 0)
	{
		echo "<table border='1'>
		<tr>
		<th>Ingredient Name</th>
		<th>Qty</th>
		<th>Unit</th>
		<th>Comment</th>
		<th>Delete</th>
		</tr>";

		while($row = $result->fetch_assoc())
		{
			echo "<tr>";
			echo "<td>" . $row['IngredientName'] . "</td>";
			echo "<td>" . $row['Qty'] . "</td>";
			echo "<td>" . $row['Unit'] . "</td>";
			echo "<td>" . $row['Comment'] . "</td>";
			echo "<td><a href='SCDeleteRecipeIngredient.php?RecipeID=".$RecipeID."&RecIngID=".$row['RecIngID']."' onClick=\"return confirm('Are you sure you want to delete?');\"><center><img src='trash-icon.png' alt='Delete' style='width:18px;height:18px;border:0'></center>
</a>";
			echo "</tr>";
		}
		echo "</table>";
	}
	$conn->close();

	echo "<a href='SCAddRecipeIngredient.php?RecipeID=".$RecipeID."' class='button'>Add Ingredient</a>";
	echo "<a href='SCIngredients.php' class='button'>View Ingredients</a>";
	echo "<a href='SCBeerRecipe.php' class='button'>View Recipes</a>";
}
?>
</center>
</body>
</html>