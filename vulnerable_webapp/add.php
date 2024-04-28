<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<html>
<head>
    <title>Add Data</title>
</head>
<body>
    <?php
    include_once("connection.php");


    if(isset($_POST['Submit'])) {
        $message = $_POST['message'];
		$message = preg_replace( '/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t/i', '', $message);

        $user_id = $_SESSION['id']; 
		
        // Insert the message into the database
		$query = "INSERT INTO forum_message (username, message) VALUES ('$user_id', '$message')";
        $result = mysqli_query($mysqli, $query);

        if($result) {
            echo "<script>alert('Message added successfully!'); window.location.href='index.php';</script>";
            exit();
        } else {
			echo ($query);
            echo "Error: " . mysqli_error($mysqli);
        }
    }
    ?>

    <a href="index.php">Home</a> | <a href="logout.php">Logout</a>
    <br/><br/>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Messages</td>
                <td><textarea name="message" rows="10" cols="50"></textarea></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
</body>
</html>
