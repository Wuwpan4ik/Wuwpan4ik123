<?php
    trait SendEmail {

        function EmailQueueApiCall($messages = false) {
            $_SESSION['error'] = $this->api_key;

            $curl = curl_init();

            $request = [
                "key" => $this->api_key,
                "messages" => $messages
            ];

            curl_setopt($curl, CURLOPT_URL, $this->api_endpoint);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, ["q" => json_encode($request)]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            return json_decode($result, true);
        }
    }