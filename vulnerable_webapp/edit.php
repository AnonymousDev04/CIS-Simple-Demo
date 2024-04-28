<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

function removeScript($value) {
    // Remove any <script> tags
    $processedValue = str_replace('<script>', '', $value);
    $processedValue = str_replace('</script>', '', $processedValue);
    
    return $processedValue;
}

if(isset($_POST['update'])) {	
    $id = $_POST['id'];
    
    $name = $_POST['name'];
    $email = removeScript($_POST['email']);
    $password = $_POST['password'];	
    
    // checking empty fields
    if(empty($name)|| empty($email)) {
        echo "<font color='red'>Please fill in all required fields.</font><br/>";
    } else {
		if (empty($password)) {
			$query = "UPDATE login SET name=?, email=? WHERE id=?";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $id);
		} else {
			$query = "UPDATE login SET name=?, email=?, password=md5(?) WHERE id=?";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $password, $id);
		}

		// Execute the prepared statement
		$result = mysqli_stmt_execute($stmt);

		// Check for success
		if ($result) {
			echo "<script>alert('Update successful!'); window.location.href='index.php';</script>";
			exit();
		} else {
			echo "<font color='red'>Error updating record: " . mysqli_error($mysqli) . "</font><br/>";
		}

		// Close the statement and connection
		mysqli_stmt_close($stmt);
		mysqli_close($mysqli);
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM login WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$email = $res['email'];
	// Set a placeholder for the password field
	$password_placeholder = "Click here to reset password";
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password" placeholder="<?php echo $password_placeholder; ?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
