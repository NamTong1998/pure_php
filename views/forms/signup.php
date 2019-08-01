<!DOCTYPE html>
<html>
<head>
	<title> Sign up </title>
	<link rel="stylesheet" href="../../assets/style.css">
	<script type="text/javascript" src="../../assets/form_validate.js">  </script>
</head>
<body>
	<form method="post" action="../../controllers/apps/SignupController.php" name="form" onsubmit="return formValidate()">
		<table class="formbox">
			<tr>
				<td colspan="2" style="text-align: center;"> <h1> Sign up </h1> </td>
			</tr>
			<tr>
				<td> <label for="username"> <b> Username: </b> </label> </td>
				<td> <input type="text" name="username" id="username"> </td>
			</tr>
			<tr>
				<td> <label for="password"> <b> Password: </b> </label> </td>
				<td> <input type="password" name="password" id="password"> </td>
			</tr>
			<tr>
				<td>  </td>
				<td> <input type="checkbox" name="remember_me"> &nbsp;Remember Me </td>
			</tr>
			<tr>
				<td>  </td>
				<td> <input type="checkbox" name="keep_login"> &nbsp;Keep Login </td>
			</tr>
			<tr>
				<td>  </td>
				<td> <input type="submit" value="Sign Up"> &nbsp;OR <a href="login.php"> Log in </a> </td>
			</tr>
		</table>
	</form>
</body>
</html>