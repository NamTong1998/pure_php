<?php
	require_once('../../Connection.php');

	class User
	{
		private $id;
		private $username;
		private $password;

		public static function all()
		{
			$con = Connection::getInstance();
			$sql = $con->query('SELECT * FROM users');
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
			$sql = $con->prepare('SELECT FROM users WHERE id=:id');
			$sql->bindParam(':id', $id);
			$sql->execute();
			$res = $sql->fetch(PDO::FETCH_ASSOC);

			return $res[0];
		}

		public function save()
		{
			$u = $this->username;
			$p = $this->password;

			$con = Connection::getInstance();
			$sql = $con->prepare('INSERT INTO users(username, password) VALUES (:username, :password)');
			$sql->bindParam(':username', $u);
			$sql->bindParam(':password', $p);
			$sql->execute();
		}
	
	    /**
	     * @return mixed
	     */
	    public function getId()
	    {
	        return $this->id;
	    }

	    /**
	     * @param mixed $id
	     *
	     * @return self
	     */
	    public function setId($id)
	    {
	        $this->id = $id;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getUsername()
	    {
	        return $this->username;
	    }

	    /**
	     * @param mixed $username
	     *
	     * @return self
	     */
	    public function setUsername($username)
	    {
	        $this->username = $username;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getPassword()
	    {
	        return $this->password;
	    }

	    /**
	     * @param mixed $password
	     *
	     * @return self
	     */
	    public function setPassword($password)
	    {
	        $this->password = $password;

	        return $this;
	    }
	}
?>