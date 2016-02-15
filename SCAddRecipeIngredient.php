<html>
<body>
<?php
include('SCEditRecipe.php');
if(isset($_POST['submit']) && isset($_GET['RecipeID']))
{	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
	
	$RecipeID = $_GET['RecipeID'];
	
	$maxIDsql = "SELECT MAX(RecIngID) FROM RECIPEINGREDIENTS";
	$RecIngID = $conn->query($maxIDsql)->fetch_assoc()["MAX(RecIngID)"] + 1;
	
	$IngredientID = mysqli_real_escape_string($conn, $_POST['IngredientIDSelect']);
	$Qty= mysqli_real_escape_string($conn, $_POST['Qty']);
	$Comment = mysqli_real_escape_string($conn, $_POST['Comment']);
	$sql = "INSERT into RECIPEINGREDIENTS VALUES('$RecIngID', '$RecipeID', '$IngredientID', '$Qty', '$Comment')";
	$result = $conn->query($sql);
	
	if($sql)
	{
		header('location:SCEditRecipe.php?RecipeID='.$RecipeID);
		echo "Ingredient Added";
	}
	$conn->close();
}
?>
<center>
<fieldset style="width:270px;height:100px;">
<form method="post" action="">
<div align="right">
<select name="IngredientIDSelect" id="IngredientIDSelect">
  <option value="">Select...</option>
  
  <?php
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Check connection
  if ($conn->connect_error) {die("Connection failed: " - $conn->connect_error);}
  
  $sqlIngSelect = "SELECT IngredientName, IngredientID, Unit, Comment FROM Ingredients";
  $resultIngSelect = $conn->query($sqlIngSelect);

  // build combo box	
  if ($resultIngSelect->num_rows > 0)
  {
	  while($rowIng = $resultIngSelect->fetch_assoc())
	  {
		  echo "<option value=". $rowIng['IngredientID'] .">". $rowIng['IngredientName'] ." - ". $rowIng['Unit'] ." - ". $rowIng['Comment'] ."</option>";
	  }
  }
  ?>
  
</select><br>
Qty: <input type="text" name="Qty"><br>
Comment: <input type="text" name="Comment"><br>
</div>
<br>
<input type="submit" name="submit">
</form>
</fieldset>
</center>
</body>
</html>