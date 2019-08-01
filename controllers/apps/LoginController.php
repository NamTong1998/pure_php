<?php
	session_start();

	require_once('../../models/User.php');
	require_once('../../Connection.php');

	class LoginController
	{
		public function checkLoginInfo()
		{
			$u = $_POST['username'];
			$p = $_POST['password'];

			$users = User::all();
			$isValid = false;

			foreach ($users as $user)
			{
				if($user['username'] == $u)
				{
					if($user['password'] == $p)
					{
						$isValid = true;;
						break;
					}
					else
					{
						continue;
					}
				}
				else
				{
					continue;
				}
			}

			if($isValid == true)
			{
				//session_start();
				$_SESSION['username'] = $u;
				header('Location: ../../views/apps/home.php');
			}
			else
			{
				header('Location: ../../views/forms/login.php');
			}
		}

		public function logout()
		{
			session_destroy();
			header('Location: ../../views/forms/login.php');
		}
	}

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$login = new LoginController();
		$login->checkLoginInfo();
	}

	if(isset($_POST['logout']))
	{
		$logout = new LoginController();
		$logout->logout();
	}
?>