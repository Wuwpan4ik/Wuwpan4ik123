<?php
	
	class AdminPageController extends ACoreCreator
	{
		function getAllClients(){
			
			$content = $this->analytic->GetAllClientsForMain($_GET["order"]);
			$i = 1;
			
			foreach($content as $item){
				?>
				<tr id="<?php if ($i % 2 == 0){ echo "white";} else { echo "grey"; }?>">
					
					<td><?php if(isset($item['email'])) echo htmlspecialchars($item['email'])?></b></td>
					
					<td><?php if(isset($item['date_start'])) echo htmlspecialchars($item['date_start'])?></td>
                    
                    <td><?php if(isset($item['date'])) echo htmlspecialchars($item['date'])?></td>

                    <td><?php if(isset($item['name'])) echo htmlspecialchars($item['name'])?></td>
                    
                    <td><a href="/admin/<?=$item['id']?>/AdminChangeUser">Изменить</a></td>
     
				</tr>
				<?php
				$i= $i+1;}
		}
		
		function get_content()
		{
			// TODO: Implement get_content() method.
		}
	}