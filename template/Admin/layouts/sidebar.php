<?php
	
	if(is_null($_SESSION["user"]["username"])){?>
		
		<div class="nav">
	
	<?}else{
		
		?>
		
		<div class="nav">
			
			<div class="open-sidebar">
				<span></span>
			</div>
			
			
			<div class="sidebar">
				
				<div class="UserProfile">
					
					<div class="UserProfile__header">
						<img id="avatar" src="/<? echo (!empty($_SESSION['user']['avatar'])  ? $_SESSION['user']['avatar'] : "uploads/ava/userAvatar.jpg") ?>"/>
						
						
						<div class="text-info">
							
							<p>Добро пожаловать,</p>
							
							
							<div class="text-info-name">
								<h1><?=$_SESSION["user"]["name"]?></h1>
							</div>
						</div>
						<div class="UserProfile__header-logo">
						
						</div>
					</div>
				
				
				</div>
                
                <?php if ($_SESSION['user']['position_user']) { ?>
				
                    <?php if ($_SESSION['user']['position_user'] == 2) { ?>
                    
                        <a href="/admin/AddUser">
                            
                            <div class="sidebarOption <? if ($_SERVER['REQUEST_URI'] == '/admin/AddUser') echo 'active'; ?>" >
                                
                                <div class="option">
                                    
                                    <img class="ico" src="/img/Main.svg">
                                    
                                    <h2>Добавить сотрудника</h2>
                                
                                </div>
                            
                            </div>
                        
                        </a>
				
				    <?php } ?>
                <?php } ?>

                <a href="/admin/UserList">

                    <div class="sidebarOption <? if ($_SERVER['REQUEST_URI'] == '/admin/UserList') echo 'active'; ?>" >

                        <div class="option">

                            <img class="ico" src="/img/Main.svg">

                            <h2>Список клиентов</h2>

                        </div>

                    </div>

                </a>

                <a href="/admin/AdminChangeUser">

                    <div class="sidebarOption <? if ($_SERVER['REQUEST_URI'] == '/admin/AdminChangeUser') echo 'active'; ?>" >

                        <div class="option">

                            <img class="ico" src="/img/Main.svg">

                            <h2>Добавить клиента</h2>

                        </div>

                    </div>

                </a>
                
                <a href="/admin/AdminStatistic">

                    <div class="sidebarOption <? if ($_SERVER['REQUEST_URI'] == '/admin/AdminStatistic') echo 'active'; ?>" >

                        <div class="option">

                            <img class="ico" src="/img/Main.svg">

                            <h2>Статистика</h2>

                        </div>

                    </div>

                </a>
			
			</div>
			
			<div class="contactSignout">
				
				<a href="/LoginController/logout">
					
					<div class="sidebarOption">
						
						<div class="option">
							
							<img class="ico" src="/img/Exit.svg">
							
							<h2>Выход</h2>
						
						</div>
					
					</div>
				
				</a>
			
			</div>
		
		</div>
	
	<?}?>
