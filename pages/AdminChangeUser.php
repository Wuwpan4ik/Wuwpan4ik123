<?php
	class AdminChangeUser extends ACoreAdmin {
		function get_content()
		{
			$data = ["user" => $this->admin_class->GetUser(), "users" => $this->user->GetCreatorUsersWithoutTariff()];
			return $data;
		}
	}
