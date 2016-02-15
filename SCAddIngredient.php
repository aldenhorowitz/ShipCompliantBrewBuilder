<html>
<body>
<?php
include('SCIngredients.php');
if(isset($_POST['submit']))
{	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
	
	$maxIDsql = "SELECT MAX(IngredientID) FROM INGREDIENTS";
	$IngredientID = $conn->query($maxIDsql)->fetch_assoc()['MAX(IngredientID)'] + 1;
	
	$IngredientName = mysqli_real_escape_string($conn, $_POST['IngredientName']);
	$Unit= mysqli_real_escape_string($conn, $_POST['Unit']);
	$Comment = mysqli_real_escape_string($conn, $_POST['Comment']);
	$sql = "INSERT into INGREDIENTS VALUES('$IngredientID', '$IngredientName', '$Unit', '$Comment')";
	$result = $conn->query($sql);
	
	if($sql)
	{
		header("location:SCIngredients.php");
		echo "Ingredient Added";
	}
	$conn->close();
}
?>
<center>
<fieldset style="width:290px;height:100px;">
<form method="post" action="">
<div align="right">
Ingredient Name: <input type="text" name="IngredientName"><br>
Unit: <input type="text" name="Unit"><br>
Comment: <input type="text" name="Comment"><br>
</div>
<br>
<input type="submit" name="submit">
</form>
</fieldset>
</center>
</body>
</html>