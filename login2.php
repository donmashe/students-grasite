<?php
if (!isset($_SESSION)) {
    session_start();
}

include "config.php";

if (isset($_POST['login'])) {
   try {
        $connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * FROM users WHERE email = :email AND password = :password;";

		$email = $_POST['email'];
		$passw = $_POST['password'];

        $statement = $connection->prepare($sql);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->bindParam(':password', $passw, PDO::PARAM_STR);
        $statement->execute();

		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		if ($statement->rowCount() > 0) {
			foreach ($result as $res) {
				$_SESSION['user_id'] = $res['id'];
				$_SESSION['user_logged_in']=$_POST['email'];
                header('location:post_details.php?id=' . $res['id']);

			}
		} else {
            echo "Invalid Username or Password.";
		}
	} catch (PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php include 'include/header.php'; ?>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<body>
	<br><br><br><br><br><br>
	<h2><p style="text-align:center"><b>Enter Login Details</h2></p>
	<div id="container">
		<form method="post" action="login2.php" id="login">
				<b><label for="username" class="lbl-login">Username:</label>
				<input type="email" name="email" placeholder="Email" id="email" size="40">
				<b><label for="psw" class="lbl-login">Password: </label>
				<input type="password" name="password" placeholder="Password" id="password" size="40">
		</div>			
				<p style="text-align:center"><input type="submit" name="login" value="Sign In" id="submit"></p>
		</form>	
			<p style="text-align:center"> Not registered?<a href="register.php"> Register Now</a></p>
			<p style="text-align:center"><a href="index.php">Back to home</a></p>
	</body>
<?php include 'include/footer.php'; ?>
