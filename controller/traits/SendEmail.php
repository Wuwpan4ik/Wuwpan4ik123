<?php
    trait SendEmail {
        function SendEmail($message) {
            $this->EmailQueueApiCall($this->api_endpoint, $this->api_key, [$message]);
        }

        function EmailQueueApiCall($endpoint, $key, $messages = false) {
            $curl = curl_init();

            $request = [
                "key" => $key,
                "messages" => $messages
            ];

            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, ["q" => json_encode($request)]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            return json_decode($result, true);
        }
    }