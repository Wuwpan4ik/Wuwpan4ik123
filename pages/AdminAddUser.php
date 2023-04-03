<?php
	class AdminAddUser extends ACoreAdmin {
		function get_content()
		{
		
		}
		
		function obr() {
			if ($_SESSION['user']['position_user'] != 2) {
				header("Location: /admin");
			}
		}
		
	}
