<?php

$db = new PDO('mysql:host=127.0.0.1; dbname=website','root','');

if (isset($_POST['email'])) 
{
	$email = $_POST['email'];

	// 2. to print message and exit from the current php script
	die($email);
	
	// use "';DROP TABLE forum_topics; --" to demonstrate the insecurity in the website
	
	// 1st remove comment from 12 to demonstrate above query
	
	// after that demonstrate how to secure the site through code at line 15 by 'prepare statment'
	
	// 1., 2., 3.(without code at line 12)
	$user = $db->query("SELECT * FROM user_data WHERE email = '{$email}'");

	// IV. For understanding: $user = $db->query("SELECT * FROM user_data WHERE email = ''; DROP TABLE forum_topics; --'");

	// 4. if attacker submits any query it won't be able to make changes to the query
	$user = $db->prepare("SELECT * FROM user_data WHERE email = :email");

	// 4.
	$user->execute(['email' => $email, ]);

	if ($user->rowCount()) 
	{
		die('Welcome!');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Reset password</title>
	<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}


.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}


</style>
	</head>
	<body>
		<h1 align="center"><b>SQL Injection</b></h1>
		<br>
		<br>
		<br>
		<br>
		<br>
		<center>
		<form action="sqlinjection.php" method="post" autocomplete="off">
			<div>
				<label for="email"><b>Email address</b></label>
				<input type="text" placeholder="Enter Email" name="email" id="email" text-align="center" required>
				<button type="submit">Recover</button>
			</div>
		</form>
		</center>
	</body>
</html>