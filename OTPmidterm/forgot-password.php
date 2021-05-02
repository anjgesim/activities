<?php
$conn = mysqli_connect('localhost','root',"",'accounts');
if(isset($_POST['submit'])){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$query = "select * from users where email ='$email'";
	$run = mysqli_query($conn, $query);
	if(mysqli_num_rows($run)>0){
		$row = mysqli_fetch_array($run);
		$db_email = $row['email'];
		$db_id = $row['id'];
		$token =uniqid(md5(time()));
		$query ="INSERT INTO password_reset(id, email, token) VALUES(NULL,'$email','$token')";
		if(mysqli_query($conn, $query)){
			$to = $db_email;
			$subject = "Password reset link";
			$message = "Click <a href='https://YOUR_wEBSITE.com/reset.php?token=$token'>here</a> to reset your password.";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers = 'From:<demo@demo.com>'."\r\n";

			mail($to, $subject, $message, $headers);
			$msg = "<div class='alert alert-success'>Password reset link has been sent to the email.</div>";
		}
	}else{
		$msg ="<div class='alert alert danger'> User not found</div>";

	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles.css">

	<title>Forgot Password</title>

<head>
	
	<body>
		<div class="container">
			<div class="row">
			<div class="">
				<h2>Forgot Password</h2><hr>
				<form action="method="post">
					<div class="form-group">
						<label for="">Enter Email</label>
						<input type="email" name="email" class="form-control">
					</div>

					<div class="form-group">
						<button name="submit" class="btn btn-primary btn-block"> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>



	</body>


















</head>