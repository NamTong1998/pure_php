<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Homepage </title>
	<link rel="stylesheet" type="text/css" href="../../assets/style.css">
	<script type="text/javascript" src="../../assets/form_validate.js">  </script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#dbtable').DataTable();
		});
	</script>
</head>
<body>
	<h1>
		<?php
			echo "Hello " . $_SESSION['username'] . ". You made it here.";
		?>
	</h1>
	<form method="post" action="../../controllers/apps/LoginController.php">
		<input type="hidden" name="logout" value="logout">
		<input type="submit" value="Logout" style="width: 80px; height: 40px; font-size: 20px;">
	</form>
	&nbsp;
	<form method="post" action="../../controllers/clients/TaskController.php">
		<table class="formbox2">
			<tr>
				<td colspan="2"> <h1> New Task Here </h1> </td>
			</tr>
			<tr>
				<td> <label for="summary"> <b> Summary: </b> </label> </td>
				<td> <input type="text" name="summary" id="summary"> </td>
			</tr>
			<tr>
				<td> <label for="detail"> <b> Detail: </b> </label> </td>
				<td> <textarea name="detail" id="detail"> </textarea> </td>
			</tr>
			<tr>
				<td> <label for="start_time"> <b> Start Time: </b> </label> </td>
				<td> <input type="datetime-local" name="start_time" id="start_time"> </td>
			</tr>
			<tr>
				<td> <label for="end_time"> <b> End Time: </b> </label> </td>
				<td> <input type="datetime-local" name="end_time" id="end_time"> </td>
			</tr>
			<tr>
				<td>  </td>
				<td> <input type="submit" name="create" value="Create"> </td>
			</tr>
		</table>
	</form>
	<h1> All Your Tasks Here </h1>
	<?php
		require_once('../../Connection.php');
		require_once('../../models/Task.php');
		require_once('../../models/User.php');
		require_once('../../controllers/clients/TaskController.php');

		$con = Connection::getInstance();
		$sql = $con->prepare("SELECT * FROM users WHERE users.username=:username");
		$sql->bindParam(':username', $_SESSION['username']);
		$sql->execute();
		$user = array();
		while($row = $sql->fetch(PDO::FETCH_ASSOC))
		{
			$user[] = $row;
		}
		$user0 = $user[0];
		$userId = $user0['id'];
		echo($userId);
		
		$tasks = new Task();
		$list = $tasks->users($_SESSION['username']);
		
		echo "<table class='dbtable' id='dbtable'>
			<tr>
				<td style='text-align:center;'> <b> ID </b> </td>
				<td style='text-align:center;'> <b> Summary </b> </td>
				<td style='text-align:center;'> <b> Detail </b> </td>
				<td style='text-align:center;'> <b> Start Time </b> </td>
				<td style='text-align:center;'> <b> End Time </b> </td>
				<td colspan='2' style='text-align:center;'> <b> Tools </b> </td>
			</tr>";
		//foreach($statement as $row) controllers/clients/TaskController.php
		foreach($list as $row)	
		{
			echo "
				<tr>
					<form method='post' action='../../controllers/clients/TaskController.php'>
						<td style='width: 50px;'> <input class='orderNumber' name='id' value='" . $row['id'] ."' readonly> </td>
						<td> <input type='text' name='summary' value='" . $row['summary'] . "'> </td>
						<td> <textarea type='text' name='detail'>" . $row['detail'] . "</textarea> </td>
						<td> <input type='text' name='start_time' value='" . $row['start_time'] . "'> </td>
						<td> <input type='text' name='end_time' value='" . $row['end_time'] . "'> </td>
						<td> <input type='submit' name='edit' value='Edit'> </td>
						<td> <input type='submit' name='delete' value='Delete'> </td>
					</form>
				</tr>
			";
		}
		echo "</table>";
	?>
</body>
</html>