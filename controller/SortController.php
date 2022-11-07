<?php
    class SortController extends ACore {
		protected $m;

        public function __construct()
        {
            $this->m = new User();
        }
		
        function getClientsForMain(){
			$get = $_GET["order"];
			
			$content = $this->m->db->query("SELECT * FROM `user` WHERE `is_creator` <> 1 ORDER BY $get" );
			
            $i = 1;

            foreach($content as $item){
                ?>
                <tr id="<?php if ($i % 2 == 0){ echo "white";} else { echo "grey"; }?>">

                    <td><img class="table_ava" src="<?php if(isset($item['avatar'])) echo htmlspecialchars($item['avatar'])?>"/><b><?php if(isset($item['first_name'])) echo htmlspecialchars($item['first_name'])?></b></td>

                    <td><?php if(isset($item['email'])) echo htmlspecialchars($item['email'])?></td>

                    <td><?php if(isset($item['status']))
                            switch ($item['status']) {
                                case '0':
                                    echo '<div class="status status-Free">Free</div>';
                                    break;
                                case '1':
                                    echo '<div class="status status-Busy">Busy</div>';
                                    break;
                                case '2':
                                    echo '<div class="status status-Working">Working</div>';
                                    break;
                            }
                        ?></td>

                    <td><?php if(isset($item['niche'])) echo htmlspecialchars($item['niche'])?></td>

                </tr>
                <?php
                $i= $i+1;}
        }
		
		function getClientsForAnalytics() {
			$get = $_GET["sort"];
			$result = $this->m->db->query("SELECT clients.id, course.name as course_name, course.id as course_id, clients.comment, clients.achivment_date, clients.give_money, first_name, email, tel FROM clients JOIN course ON clients.course_id = course.id WHERE creator_id = " . $_SESSION['user']['id']." ORDER BY " . $get);
						
				foreach($result as $client){

                    $tel = $client["tel"];

                    echo
										
					'<tr>

						<td class="nick"> <input type="checkbox" class="check_user">' . mb_strimwidth($client["first_name"], 0, 8, '') . '</td>
											
						<td>' . $client["give_money"] . ' ₽</td>

						<td>' . $client["email"] . '</td>

						<td>' . $tel  . '</td>
						
						<td><a href="/Course/' . $client["course_id"] . '">' . $client["course_name"] . '</td>

						<td>' . $client["comment"] . '</td>
											
						<td>' . $client["achivment_date"] . '</td>

						<td class="iconed">

							<span>

								<a href="/ClientsController/' . $client['id'] . '/delete"><img class="table_ico" src="img/Trash.svg"></a>

							</span>

						</td>
						
					</tr>';
										
				}
		}

        function get_content(){}


        function obr() {}
    }
