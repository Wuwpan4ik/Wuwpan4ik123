<?php
	class AdminModel extends ConnectDatabase
	{
		public function GetAdmin($username, $password)
		{
			return $this->ClearQuery("SELECT * FROM admin_users WHERE `username` = '$username' AND `password` = '$password'");
		}
		
		public function AddUser($name, $username, $password, $job)
		{
			$this->ClearQuery("INSERT INTO admin_users (`name`, `username`, `password`, `position_user`) VALUES ('$name', '$username', '$password', $job)");
		}
		
		public function CheckUser($id)
		{
			return $this->ClearQuery("SELECT * FROM users_tariff WHERE `user_id` = $id");
		}
		
		public function GetUser()
		{
			return $this->ClearQuery("SELECT user.email, users_tariff.date_start, users_tariff.date, tariffs.name FROM user INNER JOIN users_tariff ON (users_tariff.user_id = user.id) INNER JOIN tariffs ON tariffs.id = users_tariff.tariff_id  WHERE user.is_creator = 1 AND user.id = {$_SESSION['item_id']}")[0];
		}
		
		
//		Статистика
		public function GetAuthorCount()
		{
			return count($this->ClearQuery("SELECT * FROM user WHERE is_creator = 1"));
		}
		
		public function GetUserCount()
		{
			return count($this->ClearQuery("SELECT * FROM user WHERE is_creator = 0"));
		}
		
		public function GetAllCount()
		{
			return count($this->ClearQuery("SELECT * FROM user"));
		}
		
		public function GetUserWithTariff()
		{
			$current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
			return count($this->ClearQuery("SELECT * FROM users_tariff WHERE cast(date as DATE ) < cast('$current_date' as DATE)"));
		}
		
		public function GetAuthorWithoutTariffCount()
		{
			return $this->GetAuthorCount() - count($this->ClearQuery("SELECT * FROM user"));
		}
	}