<?php
class SortController extends ACoreCreator {
    protected $m;

    function getClientsForMain(){
        $get = $_GET["order"];

        $content = $this->analytic->GetClientsForMain($get);

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
        $result = $this->analytic->GetClientsForAnalytics($get);
        foreach($result as $client){

            $tel = $client["tel"];

            $date = date('d.m.Y', strtotime($client["achivment_date"]));

            if (strlen($tel) == 0) {
                $tel = '—';
            }
	
	        $currency = '';
         
	        if ($client["give_money"] == 0) {
                $money = "Не оплатил";
            } else {
		        $money = $client["give_money"];
		        if (isset($_SESSION["user"]['currency'])) {
			        $currency = $_SESSION["user"]['currency'];
		        } else {
			        $currency = "₽";
		        }
            }
            
            

            echo

                '<tr>
						<td class="nick"> <input type="checkbox" data-id="'. $client["id"] .'" class="check_user">' . mb_strimwidth($client["first_name"], 0, 8, '') . '</td>
											
						<td>'  .  $money . $currency . '</td>
						
						<td>' . $client["email"] . '</td>
						
						<td>' . $tel  . '</td>
						
						<td><a href="/Course/' . $client["course_id"] . '">' . $client["course_name"] . '</td>
											
						<td>' . $date . '</td>
						
					</tr>';

        }
    }

    function getOrdersForAnalytics() {
        $get = $_GET["sort"];
        $result_course = $this->analytic->GetOrdersForAnalytics($get);
        $count = 1;
        foreach($result_course as $order){

            $tel = $order["tel"];
            $date = date('d.m.Y', strtotime($order["achivment_date"]));

            if (strlen($tel) == 0) {
                $tel = '—';
            }

            echo

                '<tr>
                        <td> <input type="checkbox" data-id="'. $order["id"] .'" class="check_order">№' . $count . '</td>
				
						<td>' . $order["money"] . (isset($_SESSION["user"]['currency']) ? $_SESSION["user"]['currency'] : "₽") . '</td>
						
						<td>' . $order["email"] . '</td>
						
						<td>' . $tel  . '</td>
						
						<td><a href="/Course/' . $order["course_id"] . '">' . $order["course_name"] . '</td>
											
						<td>' . $date . '</td>
						
					</tr>';
            $count += 1;

        }
    }

    function get_content(){}


    function obr() {}
}