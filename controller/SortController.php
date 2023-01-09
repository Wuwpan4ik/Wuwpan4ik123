<?php
class SortController extends ACoreCreator {
    protected $m;

    public function __construct()
    {
        $this->m = new User();
    }

    function getClientsForMain(){
        $get = $_GET["order"];

        $content = $this->m->db->query("SELECT clients.email, clients.first_name, clients.give_money, clients.tel, course.id as 'course_id', course.name FROM clients, course WHERE course.id = clients.course_id AND `creator_id` = ". $_SESSION['user']['id'] ." ORDER BY $get");

        $i = 1;

        foreach($content as $item){
            ?>
            <tr id="<?php if ($i % 2 == 0){ echo "white";} else { echo "grey"; }?>">

                <td><img class="table_ava" src="<?php if(isset($item['avatar'])) {echo htmlspecialchars($item['avatar']);} else {echo "/uploads/ava/userAvatar.jpg";}?>"/><b><?php if(isset($item['first_name'])) echo htmlspecialchars($item['first_name'])?></b></td>

                <td><?php if(isset($item['email'])) echo htmlspecialchars($item['email'])?></td>

                <td><?php echo (strlen($item['tel']) > 0) ? htmlspecialchars($item['tel']) : '--';?></td>

                <td><a href="/Course/<?php echo $item['course_id']?>"><?php if(isset($item['name'])) echo htmlspecialchars($item['name'])?></a></td>

                <td><?php echo $item['give_money'];?></td>
            </tr>
            <?php
            $i= $i+1;}
    }

    function getClientsForAnalytics() {
        $get = $_GET["sort"];
        $result = $this->m->db->query("SELECT clients.id, course.name as course_name, course.id as course_id, clients.comment, clients.achivment_date, clients.give_money, first_name, email, tel FROM clients JOIN course ON clients.course_id = course.id WHERE creator_id = " . $_SESSION['user']['id']." ORDER BY " . $get);
        foreach($result as $client){

            $tel = $client["tel"];

            if (strlen($tel) == 0) {
                $tel = '—';
            }

            echo

                '<tr>

						<td class="nick"> <input type="checkbox" data-id="'. $client["id"] .'" class="check_user">' . mb_strimwidth($client["first_name"], 0, 8, '') . '</td>
											
						<td>' . $client["give_money"] . (isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : "₽") . '</td>

						<td>' . $client["email"] . '</td>

						<td>' . $tel  . '</td>
						
						<td><a href="/Course/' . $client["course_id"] . '">' . $client["course_name"] . '</td>
											
						<td>' . $client["achivment_date"] . '</td>
						
					</tr>';

        }
    }

    function getOrdersForAnalytics() {
        $get = $_GET["sort"];
        $result_course = $this->m->db->query("SELECT course.name as course_name, course.id as course_id, orders.achivment_date, orders.money, user.first_name, user.email, user.telephone, orders.id FROM orders JOIN course ON orders.course_id = course.id JOIN user ON orders.user_id = user.id WHERE creator_id = " . $_SESSION['user']['id']." ORDER BY " . $get);
       $count = 1;
        foreach($result_course as $order){
            $tel = $order["tel"];

            if (strlen($tel) == 0) {
                $tel = '—';
            }

            echo

                '<tr>
                        <td> <input type="checkbox" data-id="'. $order["id"] .'" class="check_order">' . $count . '</td>
				
						<td>' . $order["money"] . (isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : "₽") . '</td>

						<td>' . $order["email"] . '</td>

						<td>' . $tel  . '</td>
						
						<td><a href="/Course/' . $order["course_id"] . '">' . $order["course_name"] . '</td>
											
						<td>' . $order["achivment_date"] . '</td>

						<td class="iconed">
    
							<span>

								<form class="DeleteItem" action="/AnalyticController/DeleteAllOrders" method="POST">
                                    <input type="hidden" name="items_id" value="'. $order['id'] .'">
                                    <button type="submit">
                                        <img class="table_ico" src="img/Trash.svg">
                                    </button>
                                    
                                </form>

							</span>

						</td>
						
					</tr>';
            $count += 1;

        }
    }

    function get_content(){}


    function obr() {}
}
