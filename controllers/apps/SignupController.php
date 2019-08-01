<?php
	require_once('../../models/User.php');
	require_once('../../Connection.php');

	class SignupController
	{
		public function checkSignupInfo()
		{
			$u = $_POST['username'];
			$p = $_POST['password'];

			$users = User::all();
			$isAvailable = false;

			foreach ($users as $user)
			{
				if($user['username'] == $u)
				{
					$isAvailable = true;
					break;
				}
				else
				{
					continue;
				}
			}

			if($isAvailable == true)
			{
				header('Location: ../../views/forms/signup.php');
			}
			else
			{
				$user = new User();
				$user->setUsername($_POST['username']);
				$user->setPassword($_POST['password']);

				$user->save();

				session_start();
				$_SESSION['username'] = $user->getUsername();
				header('Location: ../../views/apps/home.php');
			}
		}
	}

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$signup = new SignupController();
		$signup->checkSignupInfo();
	}
?>