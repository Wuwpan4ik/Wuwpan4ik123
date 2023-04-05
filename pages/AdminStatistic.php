<?php
	
	class AdminStatistic extends ACoreAdmin
	{
		
		function get_content()
		{
			$count_creator = $this->admin_class->GetAuthorCount();
			$count_user = $this->admin_class->GetUserCount();
			$count_all_user = $this->admin_class->GetAllCount();
			$count_creator_without_tariff = $this->admin_class->GetAuthorWithoutTariffCount();
			$data = ["count_creator" => $count_creator, "count_user" => $count_user, "count_all_user" => $count_all_user, 'count_creator_without_tariff' => $count_creator_without_tariff];
			return $data;
		}
	}