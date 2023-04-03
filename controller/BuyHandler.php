<?php
// Проверка Хука с Prodamus (Не уверен, что работает)
    class BuyHandler extends ACoreCreator {
	    use GenerateRandomPassword;
		
		private $password;
	
	
	    private function GetRegistrationClientHtml($name, $cost, $email, $course_count, $currency = '₽', $phone = null, $user_name = null, $number_funnel = null, $number_slide = null)
	    {
		    $result = include "./template/templates_email/u-vas-kupili-kurs(client).php";
		    return $result;
	    }
	
	    private function GetClient($course_id) {
		    return $this->clients->GetClientByIdAndEmail($course_id, $this->email);
	    }
	
	    private function GetPriceOfCourse($course_id) {
		    return $this->course->Get(["id" => $course_id]);
	    }
	
	    public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price) {
		    $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
		    $data = [
			    "first_name" => $this->name,
			    "email" => $this->email,
			    "tel" => $this->phone,
			    "creator_id" => $creator_id,
			    "course_id" => $course_id,
			    "give_money" => $course_price,
			    "buy_progress" => $buy_progress,
			    "achivment_date" => $current_date
		    ];
		    $this->clients->InsertQuery("clients", $data);
		
		    return true;
	    }
		
        public function BuyTariff()
        {
            $secret_key = $this->tariff_class->ClearQuery("SELECT prodamus_key FROM secret_prodamus_key")[0]['prodamus_key'];
            $headers = apache_request_headers();

            try {
                if ( empty($_POST) ) {
                    throw new Exception('$_POST is empty');
                }
                elseif ( empty($headers['Sign']) ) {
                    throw new Exception('signature not found');
                }
                elseif ( !Hmac::verify($_POST, $secret_key, $headers['Sign']) ) {
                    throw new Exception('signature incorrect');
                }

                http_response_code(200);

//              Покупка тарифа
                if (in_array($headers['products'][0]['sku'], [1, 2, 3])) {
                    $user_id = $this->user->getUserByEmail($headers['customer_email']);
                    $tariff_id = $headers['products']['sku'];
                    if ($this->tariff_class->BuyTariff($user_id, $tariff_id)) {
                        $tariff_name = $this->tariff_class->GetTariff($user_id);
                        $date = date("d.m.Y", strtotime($tariff_name[0]['date']));
                        $this->notifications_class->addNotifications("Тариф “{$tariff_name[0]['name']}” подключен", "Теперь ваш аккаунт получил все доступные функции до $date", '/img/Notification/cart.svg','item-like', $user_id);
                    }

                    $_SESSION['user']['tariff'] = $tariff_id;
                }
            }
            catch (Exception $e) {
                http_response_code($e->getCode() ? $e->getCode() : 400);
                printf('error: %s', $e->getMessage());
            }
        }
	
	    public function CreateLinkBuyCourse()
	    {
		    if ($_POST['first_name']) $data['customer_name'] = $_POST['first_name'];
		    if ($_POST['email']) $data['customer_email'] = $_POST['email'];
		    if ($_POST['phone']) $data['customer_phone'] = $_POST['phone'];
		
		    $product = $this->course->Get(['id' => $_POST['course_id']])[0];
			
			$secret_key = $this->purchase->GetSecretKey($_POST['creator_id']);
		
		    $data = [
			    'do' => 'pay',
			    
			    'customer_extra' => '{"creator_id":"' . $_POST['creator_id'] . '", "course_id":"'. $_POST['course_id'] .'",
			     "funnel_id":"'. $_POST['funnel_id'] .'"}, "slide_id":"'. $_POST['slide_id'] .'"',
			
			    'products' => [
				    [
					    'name' => (string)$product['name'],
					
					    'price' => (string)$product['price'],
					
					    'quantity' => "1",
					
					    'sku' => (string)$product['id']
				    ],
			    ],
			    'paid_content' => 'Приятного пользования сервисом Course Creator!'
		    ];
			
		    $data['signature'] = Hmac::create($data, $secret_key);
		
		    $url = utf8_encode($this->purchase->GetProdamusUrl($_POST['creator_id']) . '?' . http_build_query($data));
			print_r($url);
			return 1;
		}
	
	    public function BuyCourse() {
		    $headers = apache_request_headers();
		    $data = json_decode($headers['customer_extra'], true);
		    $user = $this->user->getUserById($data['creator_id'])[0];
			$secret_key = $this->purchase->GetSecretKey($data['creator_id']);
		
		    try {
			    if ( empty($_POST) ) {
				    throw new Exception('$_POST is empty');
			    }
			    elseif ( empty($headers['Sign']) ) {
				    throw new Exception('signature not found');
			    }
			    elseif ( !Hmac::verify($_POST, $secret_key, $headers['Sign']) ) {
				    throw new Exception('signature incorrect');
			    }
			
			    http_response_code(200);
			
			    $buy_progress = include './settings/buy_progress.php';
				
			    $creator_id = $data['creator_id'];
			    $course_id = $data['course_id'];
				$funnel_id = $data['funnel_id'];
				$slide_id = $data['slide_id'];
				$name = $headers['customer_name'];
			    $email = $headers['customer_email'];
			    $phone = $headers['customer_phone'];
				
			    $client = $this->GetClient($course_id);
			    $comment = 'Купил курс';
			
			    if (isset($_POST['funnel_id'])) {
				    $name_funnel = $this->funnel->Get(["id" => $funnel_id])[0]['name'];
			    }
			    if (isset($slide_id)) {
				    $number_slide = $slide_id;
			    }
			
			    //          Проверка на покупку того же курса
			    if (isset($client) && ($client[0]['buy_progress'] == $buy_progress[$comment])) {
				    die(header("HTTP/1.0 404 Not Found"));
			    }
			
			
			    $give_money = $client[0]['give_money'] + $this->GetPriceOfCourse($course_id)[0]['price'];

//          Добавление User
			
			    if (count($this->user->getUserByEmail($email)) != 1) {
				    $this->password = $this->GenerateRandomPassword(12);
				    $data = [
					    "email" => $email,
					    "password" => $this->password,
					    "is_creator" => 0
				    ];
				    $this->user->InsertQuery("user", $data);
				
				    $query = [];
				    if (isset($name)) {
					    $query["first_name"] = $name;
				    }
				
				    if (isset($phone)) {
					    $query["telephone"] = $phone;
				    }
				
				    if (!empty($query)) {
					    $this->user->UpdateQuery("user", $query, "WHERE `email` = {$email}");
				    }
			    }
			
			    $res = $this->user->getUserByEmail($email)[0];
			    $purchase = $this->purchase->GetQuery("purchase", ["user_id" => $res['id']]);
			
			    if (isset($client) && ($client[0]['buy_progress'] < $buy_progress[$comment])) {

//          Добавление Clients
				    if (count($client) == 1) {
					    $data = [
						    "buy_progress" => $buy_progress[$comment],
						    "give_money" => $give_money,
						    "first_buy" => 0
					    ];
					    $this->clients->UpdateQuery("clients", $data, "WHERE `creator_id` = '$creator_id' AND `course_id` = '$course_id' AND `email` = '$email'");
				    } else {
					    $this->InsertToTable($creator_id, $course_id, $buy_progress[$comment], $give_money);
				    }

//          Добавление Order
				    $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
				    $data = [
					    "user_id" => $res['id'],
					    "course_id" => $course_id,
					    "creator_id" => $creator_id,
					    "money" => $give_money,
					    "achivment_date" => $current_date
				    ];
				    $this->orders->InsertQuery("orders", $data);

//              Добавление Purchase
				    if (isset($purchase) && count($purchase) == 1) {
					    $purchase_info = json_decode($purchase[0]['purchase'], true);
					    if (!in_array($course_id, $purchase_info['course_id'])) {
						    array_push($purchase_info['course_id'], $course_id);
						    $this->purchase->UpdateQuery("purchase", ["purchase" => json_encode($purchase_info)], "WHERE user_id = " . $res['id']);
					    } else {
						    return false;
//                      Тут ошибка если уже покупал курс
					    }
				    } else {
					    $purchase_text = '{"course_id":["' . $course_id . '"], "video_id":[]}';
					    $this->purchase->InsertQuery("purchase", ["user_id" => $res['id'], "purchase" => $purchase_text]);
				    }
				    $course_info = $this->course->GetCourseInfoForNotifications($course_id);
				
				    $creator = $this->user->getUserById($creator_id);

//              Добавление уведомлений
				    $this->notifications_class->addNotifications("Вы купили курс", "Доступный курс - {$course_info['name']}", '/img/Notification/star.svg', 'item-like', $res['id']);
				    $this->notifications_class->addNotifications("У вас купили курс", "Ваш курс - “{$course_info['name']}”, купил {$email}", '/img/Notification/star.svg', 'item-like', $creator_id);
				    $creator_username = strtolower($creator[0]['username']);
				    $url = "https://{$creator_username}.course-creator.io/UserLogin";
				    $body = include "./template/templates_email/registracia-usera(user).php";
				    $this->SendEmail(
					    [
						    "from" => "{$this->ourEmail}",
						    'from_name' => "Course Creator IO",
						    "to" => "{$email}",
						    "sender" => "{$this->ourEmail}",
						    "subject" => "Покупка курса",
						    "content" => "$body",
						    "is_send_now" => 1
					    ]
				    );
				
				    $body = $this->GetRegistrationClientHtml($course_info['name'], $course_info['price'], $email, $course_info['count'], $res['currency'], $phone, $name, $name_funnel, $number_slide);
				    $this->SendEmail(
					    [
						    "from" => "{$this->ourEmail}",
						    'from_name' => "Course Creator IO",
						    "to" => "{$course_info['email']}",
						    "sender" => "{$this->ourEmail}",
						    "subject" => "У вас купили курс",
						    "content" => "$body",
						    "is_send_now" => 1
					    ]
				    );
			    }
		    }
		    catch (Exception $e) {
			    http_response_code($e->getCode() ? $e->getCode() : 400);
			    printf('error: %s', $e->getMessage());
		    }
		}
    }