<?php
    class SortController extends ACore {
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

        function obr()
        {
            // TODO: Implement obr() method.
        }
    }
