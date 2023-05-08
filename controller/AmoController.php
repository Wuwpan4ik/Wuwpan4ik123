<?php
	class AmoController extends ACoreAdmin
	{
		protected $link = "https://headdotwocspace.amocrm.ru/oauth2/access_token";
		protected $client_secret = 'WgCp4ddacLiK1Lv36jhIdXaHh9KAstFTRrxB5uhYUl4gPKtTnOGoF7KpXxubbK8w'; // Секретный ключ
		protected $client_id     = '41399cbc-53a6-44b5-accc-cb300733bfa4'; // ID интеграции
		protected $code          = 'def5020022633331f9567bb5e6b3edbf4819dc4a8b608e24ec19acdf499067ba241d1b10f55cf1bd43941d66a5d68f7d6a206ea1b42980ba22308acaff70bfd47b70284cf13ef102722bff31442ce1a5df425cb66e7d68310b7cfaafeae626f530c76bc5dcd1785ca3f9ca29c02e510d75f5d66ed9c26c51f38e98cdf38f56c1d534ae0f87d4d66289e779dce7cbdb5a870e4bedc45fb8ea715021ba0dd98835a603f3b1a53ffeb7a5b2047c92f7a12923837874c8ea04fa3e0ae294107a5348b06f78a1667b62398dad3f55b6505a211e3265b387f7fb3e653d13e5f96c626dad501e45d811a2393b6f18840ccb93295061f9ac1f2bc3e37ff900337db63bc9125ae29d64160996e53a1bc0c9cd57f3b7d6ce618ab42dcc9bc9796841e519359bac74017cf33a1d72057e1a40b0eee7765035e7f7dbbc3678a63b7d9378e900c47eb86ad6f9d800a0eb8bc0dd6e0089bc5d514003067b067b2ab1a0ac791610cbd5a01415946fd907eaab85440f86f634146c4c71b8c55f278ecb61cb31a9826268850278114a73e531c6a02e825d070c8f570da37578a2478340db8936c23a6e17354bcf2260bf884506c18ee8c30d661f74db8e1a9b6f2ad3fb552d104c405a88404d99da7ff8832e78c12d599473431180a6b18b3f19340599ee75d72539a99ed51328cdb37e67fc49ebc6c515';
		protected $redirect_uri  = 'https://couser-creator.io/amo/amo.php';
		
		public function checkTariffs()
		{
			$link = $this->link;
			
			$data = [
				'client_id'     => $this->client_id,
				'client_secret' => $this->client_secret,
				'grant_type'    => 'authorization_code',
				'code'          => $this->code,
				'redirect_uri'  => $this->redirect_uri,
			];
			
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
			curl_setopt($curl,CURLOPT_URL, $link);
			curl_setopt($curl,CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
			curl_setopt($curl,CURLOPT_HEADER, false);
			curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
			$out = curl_exec($curl);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			$code = (int)$code;
			
			$errors = [
				301 => 'Moved permanently.',
				400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
				401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
				403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
				404 => 'Not found.',
				500 => 'Internal server error.',
				502 => 'Bad gateway.',
				503 => 'Service unavailable.'
			];
			
			if ($code < 200 || $code > 204) die( "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error') );
			
			
			$response = json_decode($out, true);
			
			$arrParamsAmo = [
				"access_token"  => $response['access_token'],
				"refresh_token" => $response['refresh_token'],
				"token_type"    => $response['token_type'],
				"expires_in"    => $response['expires_in'],
				"endTokenTime"  => $response['expires_in'] + time(),
			];
			
			$arrParamsAmo = json_encode($arrParamsAmo);
				echo $arrParamsAmo;
				$this->user->ClearQuery("UPDATE amo_key set amo_key = {$arrParamsAmo}")[0]['amo_key'];
			
//			$array = array(
//				'email' => "{$_SESSION['user']['email']}",
//				'name' => "{$_SESSION['user']['first_name']} ${$_SESSION['user']['second_name']}",
//				'price' => 0,
//				'pipeline_id' => 6741718,
//			);
//
//			$ch = curl_init('https://dev.salesevolution.ru/pub/source-connector/form-getter.php/headdotwocspace/ViewTariffs');
//			curl_setopt($ch, CURLOPT_POST, 1);
//			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
//			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//			curl_setopt($ch, CURLOPT_HEADER, false);
//			echo curl_exec($ch);
//			curl_close($ch);
		}
		
		function get_content()
		{
		
		}
	}