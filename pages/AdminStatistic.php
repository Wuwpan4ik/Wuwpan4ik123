<?php
	
	class AdminStatistic extends ACoreAdmin
	{
		
		function get_content()
		{
			$count_creator = $this->admin_class->GetAuthorCount();
			$count_user = $this->admin_class->GetUserCount();
			$count_all_user = $this->admin_class->GetAllCount();
			$data = ["count_creator" => $count_creator, "count_user" => $count_user, "count_all_user" => $count_all_user];
			return $data;
		}
	}