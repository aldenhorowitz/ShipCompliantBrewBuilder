<html>
<body>
<link rel="stylesheet" type="text/css" href="SCTable.css" />
<center>
<h1>RECIPES</h1>
<fieldset style="width:270px;height:24px;">
<form action="SCBeerRecipe.php" method="get">
<input type="text" name="SearchText">
<input type="submit" name="submit" value="Search">
</form>
</fieldset>
<?php

$servername = "localhost";
$username = "root";
$password = "ShipCompliant";
$dbname = "SCBeerRecipe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) { die("Connection failed: " - $conn->connect_error);}

// Select recipes
if(isset($_GET['SearchText']))
{
	$sql = "SELECT RecipeID, RecipeName, User, Comment
	FROM RECIPES
	WHERE RecipeName LIKE '%". mysqli_real_escape_string($conn, $_GET['SearchText']). "%'
	OR    User LIKE '%". mysqli_real_escape_string($conn, $_GET['SearchText']). "%'
	OR    Comment LIKE '%". mysqli_real_escape_string($conn, $_GET['SearchText']). "%'";
}
else
{
	$sql = "SELECT RecipeID, RecipeName, User, Comment FROM RECIPES";
}
$result = $conn->query($sql);

// built table and output data of each row	
if ($result->num_rows > 0)
{
	echo "<table border='1'>
	<tr>
	<th>Recipe Name</th>
	<th>Brewmaster</th>
	<th>Comment</th>
	<th>Delete</th>
	</tr>";

	while($row = $result->fetch_assoc())
	{
		echo "<tr>";
		echo "<td><a href='SCEditRecipe.php?RecipeID=".$row['RecipeID']."'>" . $row['RecipeName'] . "</a></td>";
		echo "<td>" . $row['User'] . "</td>";
		echo "<td>" . $row['Comment'] . "</td>";
		echo "<td><a href='SCDeleteRecipe.php?RecipeID=".$row['RecipeID']."' onClick=\"return confirm('Are you sure you want to delete?');\"><center><img src='trash-icon.png' alt='Delete' style='width:18px;height:18px;border:0'></center></a>";
		echo "</tr>";
	}
	echo "</table>";
}
$conn->close();
?>
<a href="SCAddRecipe.php" class="button">Add Recipe</a>
<a href="SCIngredients.php" class="button">View Ingredients</a>
</center>
</body>
</html>