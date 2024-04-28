<?php session_start(); ?>
<html>
<head>
	<title>Login</title>
</head>

<body>
<a href="index.php">Home</a> <br />
<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$user = $_POST['username'];
	$pass = md5($_POST['password']);

	if($user == "" || $pass == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login_easy.php'>Go back</a>";
	} else {
		if (preg_match("/superadmin/", $user)) {
			$query = "SELECT * FROM login WHERE username=? AND password = ?";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
		} else {
			$sql_query = "SELECT * FROM login WHERE username='$user' AND password = '$pass'";
			echo $sql_query.'<br>';
			$result = mysqli_query($mysqli, $sql_query)
						or die("Could not execute the select query.");
			
			$row = mysqli_fetch_assoc($result);
		}			
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['username'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {
			echo "Invalid username or password.";
			echo "<br/>";
			echo "<a href='login_bit_harder.php'>Go back</a>";
		}

		if(isset($_SESSION['valid'])) {
			header('Location: index.php');			
		}
	}
} else {
?>
	<p><font size="+2">Login (Secure)</font></p>
	<form name="form1" method="post" action="">
		<table width="75%" border="0">
			<tr> 
				<td width="10%">Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table>
	</form>
<?php
}
?>
</body>
</html>
