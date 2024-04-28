<html>
<head>
	<title>Register</title>
</head>

<body>
<a href="index.php">Home</a> <br />
<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$pass = $_POST['password'];

	if($user == "" || $pass == "" || $name == "" || $email == "") {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {
		$name = strip_tags($name);
		$email = strip_tags($email);
		$user = strip_tags($user);
		$pass = strip_tags($pass);
		$hashedPass = md5($pass);

		$query = "INSERT INTO login(name, email, username, password, password_txt) VALUES (?, ?, ?, ?, ?)";
		$stmt = $mysqli->prepare($query);

		// Bind parameters to the prepared statement using variables
		$stmt->bind_param("sssss", $name, $email, $user, $hashedPass, $pass);
		$stmt->execute();

		if ($stmt->affected_rows > 0) {
			echo "Registration successfull!";
			echo "<br/>";
			echo "Please continue to login from <a href='index.php'>Home</a> page";
		} else {
			echo "Error: Could not execute the insert query.";
		}
		$stmt->close();
		$mysqli->close();
	}
} else {
?>
	<p><font size="+2">Register</font></p>
	<form name="form1" method="post" action="">
		<table width="75%" border="0">
			<tr> 
				<td width="10%">Full Name</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email"></td>
			</tr>			
			<tr> 
				<td>Username</td>
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
