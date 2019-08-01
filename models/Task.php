<?php
	require_once('../../Connection.php');
	require_once('../../models/User.php');	

	class Task
	{
		public $id;
		public $user_id;
		public $summary;
		public $detail;
		public $start_time;
		public $end_time;

		public static function all()
		{
			$con = Connection::getInstance();
			$sql = $con->query('SELECT * FROM tasks');
			$res = array();

			while($row = $sql->fetch(PDO::FETCH_ASSOC))
			{
				$res[] = $row;
			}

			return $res;
		}

		public static function find($id)
		{
			$con = Connection::getInstance();
			$sql = $con->prepare('SELECT FROM tasks WHERE id=:id');
			$sql->bindParam(':id', $id);
			$sql->execute();
			$res = $sql->fetch(PDO::FETCH_ASSOC);

			return $res[0];
		}

		public function save()
		{
			$user_id = $this->user_id;
			$summary = $this->summary;
			$detail = $this->detail;
			$start_time = $this->start_time;
			$end_time = $this->end_time;

			$con = Connection::getInstance();
			$sql = $con->prepare('INSERT INTO tasks(user_id, summary, detail, start_time, end_time) VALUES (:user_id, :summary, :detail, :start_time, :end_time)');
			$sql->bindParam(':user_id', $user_id);
			$sql->bindParam(':summary', $summary);
			$sql->bindParam(':detail', $detail);
			$sql->bindParam(':start_time', $start_time);
			$sql->bindParam(':end_time', $end_time);
			$sql->execute();
		}

		public function users($username)
		{
			$con = Connection::getInstance();
			$sql = $con->prepare("SELECT tasks.id, tasks.summary, tasks.detail, tasks.start_time, tasks.end_time FROM tasks, users WHERE tasks.user_id=users.id AND users.username=:username");
			$sql->bindParam(':username', $username);
			$sql->execute();
			$res = array();

			while($row = $sql->fetch(PDO::FETCH_ASSOC))
			{
				$res[] = $row;
			}

			return $res;
		}
	}
?>