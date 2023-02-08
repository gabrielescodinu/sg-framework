<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>HOME</title>
	</head>

	<body>
		<?php if ($_SESSION['user_is_admin'] == '1') {
		?>
			<!-- admin panel -->
			<div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
				<h1>Hello <?= $_SESSION['user_full_name'] ?></h1>
				<p>You are an Admin</p>
				<a href="logout.php" class="btn btn-warning">LOGOUT</a>
				<a href="students/index.php">Students</a>
				<a href="users/index.php">Users</a>
			</div>
		<?php
		} else {
		?>
			<!-- guest panel -->
			<div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
				<h1>Hello <?= $_SESSION['user_full_name'] ?></h1>
				<p>You are a guest</p>
				<a href="logout.php" class="btn btn-warning">LOGOUT</a>
				<a href="students/list.php">Students</a>
			</div>
		<?php
		}
		?>

	</body>

	</html>
<?php
} else {
	header("Location: login.php");
}
?>