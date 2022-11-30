<?php
class SortController extends ACoreCreator {
    protected $m;

    public function __construct()
    {
        $this->m = new User();
    }

    function getClientsForMain(){
        $get = $_GET["order"];

        $content = $this->m->db->query("SELECT clients.email, clients.first_name, clients.give_money, clients.tel, clients.tel, course.id as 'course_id', course.name FROM clients, course WHERE course.id = clients.course_id AND `creator_id` = ". $_SESSION['user']['id'] ." ORDER BY $get");

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

						<td class="nick"> <input type="checkbox" class="check_user">' . mb_strimwidth($client["first_name"], 0, 8, '') . '</td>
											
						<td>' . $client["give_money"] . ' ₽</td>

						<td>' . $client["email"] . '</td>

						<td>' . $client["telephone"]  . '</td>
						
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
