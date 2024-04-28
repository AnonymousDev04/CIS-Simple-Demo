<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="header">
		Welcome To Hacking101 Page!
	</div>
	<?php
	if(isset($_SESSION['valid'])) {			
    include("connection.php"); // Including the database connection file
	
	function blurUsername($username) {
    if (strlen($username) >= 3) {
        $blurred = substr($username, 0, -3) . '***';
    } else {
        $blurred = str_repeat('*', strlen($username));
    }
    return $blurred;
}

    // Fetching data from the forum_message table for the logged-in user
    $result_view = mysqli_query($mysqli, "
	SELECT forum_message.message, forum_message.time, login.username
	FROM forum_message
	LEFT JOIN login ON forum_message.username = login.id
	ORDER BY forum_message.time DESC;");
	
	$user_id = $_SESSION['id'];
	$fullname_query = mysqli_query($mysqli, "SELECT name, username, email FROM login WHERE id = $user_id");
	$row = mysqli_fetch_assoc($fullname_query);
	?>
    
	Welcome <strong id="username_dis"><?php echo $row['username'] ?></strong> ! <a href='logout.php'>Logout</a><br/>
    <br/>
    Full Name: <strong id="fullname_dis"><?php echo $row['name']; ?></strong><br/>
	Email: <strong id="email_dis"><?php echo $row['email']; ?></strong><br/>
	<a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a> 
	<br/>
	<br/>
	<a href="index.php">Home</a> | <a href="add.php">Add New Messages</a>
    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td>Username</td>
            <td>Message</td>
            <td>Time</td>
        </tr>
        <?php
        while($res = mysqli_fetch_array($result_view)) {		
            echo "<tr>";
            echo "<td>".blurUsername($res['username'])."</td>";
            echo "<td>".$res['message']."</td>";
            echo "<td>".$res['time']."</td>";	
        }
        ?>
    </table>
		<br/><br/>
	<?php	
	} else {
		echo "You must be logged in to view this page.<br/><br/>";
		echo "<a href='login_easy.php'>Login</a> | <a href='login_bit_harder.php'>Login(Secure)</a> | <a href='register.php'>Register</a>";
	}
	?>
	
</body>
</html>

