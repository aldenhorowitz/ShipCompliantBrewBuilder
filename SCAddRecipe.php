<html>
<body>
<?php
include('SCBeerRecipe.php');
if(isset($_POST['submit']))
{	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
	
	$maxIDsql = "SELECT MAX(RecipeID) FROM RECIPES";
	$RecipeID = $conn->query($maxIDsql)->fetch_assoc()["MAX(RecipeID)"] + 1;
	
	$RecipeName = mysqli_real_escape_string($conn, $_POST['RecipeName']);
	$User= mysqli_real_escape_string($conn, $_POST['User']);
	$Comment = mysqli_real_escape_string($conn, $_POST['Comment']);
	$sql = "INSERT into RECIPES VALUES('$RecipeID', '$RecipeName', '$User', '$Comment')";
	$result = $conn->query($sql);
	
	if($sql)
	{
		header("location:SCBeerRecipe.php");
		echo "Recipe Added";
	}
	$conn->close();
}
?>
<center>
<fieldset style="width:270px;height:100px;">
<form method="post" action="">
<div align="right">
Recipe Name: <input type="text" name="RecipeName"><br>
Brewmaster: <input type="text" name="User"><br>
Comment: <input type="text" name="Comment"><br>
</div>
<br>
<input type="submit" name="submit">
</form>
</fieldset>
</center>
</body>
</html>