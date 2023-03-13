<?php
// Проверка Хука с Prodamus (Не уверен, что работает)
    class BuyHandler extends ACoreCreator {
        public function BuyHandlerCheck()
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
    }