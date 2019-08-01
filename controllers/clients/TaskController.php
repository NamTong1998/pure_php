<?php
	require_once('../../models/Task.php');
	require_once('../../Connection.php');

	class TaskController
	{
		public function create()
		{

		}

		public function store()
		{
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

			$task = new Task();
			$task->user_id = $userId;
			$task->summary = $_POST['summary'];
			$task->detail = $_POST['detail'];
			$task->start_time = $_POST['start_time'];
			$task->end_time = $_POST['end_time'];
			$task->save();

			header('Location: ../../views/apps/home.php');
		}

		public function edit($id)
		{

		}

		public function update($id)
		{
			$con = Connection::getInstance();
			$sql = $con->prepare("UPDATE tasks SET summary=:summary, detail=:detail, start_time=:start_time, end_time=:end_time WHERE id=:id");
			$sql->bindParam(':summary', $_POST['summary']);
			$sql->bindParam(':detail', $_POST['detail']);
			$sql->bindParam(':start_time', $_POST['start_time']);
			$sql->bindParam(':end_time', $_POST['end_time']);
			$sql->bindParam(':id', $id);
			$sql->execute();

			header('Location: ../../views/apps/home.php');
		}

		public function destroy($id)
		{
			$con = Connection::getInstance();
			$sql = $con->prepare("DELETE FROM tasks WHERE id=:id");
			$sql->bindParam(':id', $id);
			$sql->execute();

			header('Location: ../../views/apps/home.php');
		}
	}

	if(isset($_POST['create']))
	{
		$taskCtrl = new TaskController();
		$taskCtrl->store();
	}
	if(isset($_POST['edit']))
	{
		$taskCtrl = new TaskController();
		$taskCtrl->update($_POST['id']);
	}
	if(isset($_POST['delete']))
	{
		$taskCtrl = new TaskController();
		$taskCtrl->destroy($_POST['id']);
	}
?>