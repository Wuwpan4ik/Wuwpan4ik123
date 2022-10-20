<?php
    class SortController {
		protected $m;

        public function __construct()
        {
            $this->m = new User();
        }
		
        function get_content(){
			$get = $_GET["order"];
			
			$content = $this->m->db->query("SELECT * FROM user ORDER BY " . $get);
			
            $i = 1;
				
					foreach($content as $item){

						if ($i % 2 == 0){ echo

							'<tr id="white">

								<td><img class="table_ava" src="' . $item["avatar"] . '"/><b>' . $item["first_name"] . '</b></td>

								<td>' . $item["email"] . '</td>

								<td>' . $item["status"] . '</td>

								<td>' . $item["niche"] . '</td>

							</tr>';

						}else{ echo

							'<tr id="grey">

								<td><img class="table_ava" src="' . $item["avatar"] . '"/><b>' . $item["first_name"] . '</b></td>

								<td>' . $item["email"] . '</td>

								<td>' . $item["status"] . '</td>

								<td>' . $item["niche"] . '</td>

							</tr>';

						} $i= $i+1;}
        }
		
		function get_sum() {
			$get = $_GET["sort"];
			$current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
			$last_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
			
			$content[0] = $this->m->db->query("SELECT * FROM clients WHERE creator_id = " . $_SESSION['user']['id'] . " AND achivment_date BETWEEN CAST('$last_date' AS DATE) AND CAST('$current_date' AS DATE) ORDER BY " . $get);
			$content[1] = $this->m->db->query("SELECT * FROM user WHERE id IN (SELECT client_id FROM clients WHERE creator_id = " . $_SESSION['user']['id'].")");
			
			$i = 0;
			
				foreach($content[0] as $client){ echo
										
					'<tr>

						<td class="nick"> <input type="checkbox">' . $content[1][$i]["first_name"] . ' ' . $content[1][$i]["second_name"] . '</td>
											
						<td>' . $client["give_money"] . ' ₽</td>

						<td>' . $content[1][$i]["email"] . '</td>

						<td>' . $content[1][$i]["telephone"] . '</td>

						<td>' . $client["comment"] . '</td>
											
						<td>' . $client["achivment_date"] . '</td>

						<td class="iconed">Соц. сети

							<span>

								<img class="table_ico" src="img/Option.svg">

								<img class="table_ico" src="img/Dots.svg">

							</span>

						</td>

					</tr>';
										
				$i++;}
		}
    }
