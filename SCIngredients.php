<html>
<body>
<link rel="stylesheet" type="text/css" href="SCTable.css" />
<center>
<h1>INGREDIENTS</h1>
<fieldset style="width:270px;height:24px;">
<form action="SCIngredients.php" method="get">
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
	$sql = "SELECT IngredientID, IngredientName, Unit, Comment
	FROM INGREDIENTS
	WHERE IngredientName LIKE '%". mysqli_real_escape_string($conn, $_GET['SearchText']). "%'
	OR    Unit LIKE '%". mysqli_real_escape_string($conn, $_GET['SearchText']). "%'
	OR    Comment LIKE '%". mysqli_real_escape_string($conn, $_GET['SearchText']). "%'";
}
else
{
	$sql = "SELECT IngredientID, IngredientName, Unit, Comment FROM INGREDIENTS";
}
$result = $conn->query($sql);

// build table and output data of each row	
if ($result->num_rows > 0)
{
	echo "<table border='1'>
	<tr>
	<th>Ingredient Name</th>
	<th>Unit</th>
	<th>Comment</th>
	<th>Delete</th>
	</tr>";

	while($row = $result->fetch_assoc())
	{
		echo "<tr>";
		echo "<td>" . $row['IngredientName'] . "</td>";
		echo "<td>" . $row['Unit'] . "</td>";
		echo "<td>" . $row['Comment'] . "</td>";
		echo "<td><a href='SCDeleteIngredient.php?IngredientID=".$row['IngredientID']."' onClick=\"return confirm('Are you sure you want to delete?');\"><center><img src='trash-icon.png' alt='Delete' style='width:18px;height:18px;border:0'></center></a>";
		echo "</tr>";
	}
	echo "</table>";
}
$conn->close();
?>
<a href="SCAddIngredient.php" class="button">Add Ingredient</a>
<a href="SCBeerRecipe.php" class="button">View Recipes</a>
</center>
</body>
</html>