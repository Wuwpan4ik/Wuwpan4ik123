<?php
	class AdminController extends ACoreAdmin
	{
		public function Login()
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$res = $this->admin_class->GetAdmin($username, $password);
			unset($_SESSION["user"]);
			if(count($res) != 0) {
				$_SESSION["user"] = [
					'id' => $res[0]['id'],
					'username' => $res[0]['username'],
					'name' => $res[0]['name'],
					'position_user' => $res[0]['position_user']
				];
				header('Location: /admin');
				return True;
			} else {
				$response = "Неверный логин или пароль";
				echo $response;
				die(header("HTTP/1.0 404 Not Found"));
			}
		}
		
		public function AddAdmin()
		{
			$name = $_POST['name'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$job = $_POST['job'];
			
			$this->admin_class->AddUser($name, $username, $password, $job);
			header('Location: /admin');
		}
		
		public function ChangeUser()
		{
			$user_id = $_POST['user_id'];
			$date_start = $_POST['date_start'];
			$date = $_POST['date'];
			$tariff_id = $_POST['tariff'];
			if (empty($this->admin_class->CheckUser($user_id))) {
				$this->admin_class->InsertQuery("users_tariff", ["user_id" => $user_id, 'date_start' => $date_start,
					'date' => $date, "tariff_id" => $tariff_id]);
			} else {
				$_SESSION['error'] = 1;
				$this->admin_class->UpdateQuery("users_tariff", ['tariff_id' => $tariff_id, 'date_start' => $date_start,
					'date' => $date], "WHERE user_id = $user_id");
			}
			header('Location: /admin');
		}
		
		function get_content()
		{
		
		}
	}