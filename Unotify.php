<?php

# Unotify

namespace UnotifySDK;

class Unotify
{
	public string $api_token;
	public string $url_base;
	
	public function __construct($api_token, $url_base)
	{
		$this->api_token = $api_token;
		$this->url_base = $url_base;
	}
	
	public function obterAcesso($hostname = false)
	{
		if (php_sapi_name()==='cli' && !$hostname) {
			exit('No modo cli você deve especificar explicitamente o nome do host como argumento.' . PHP_EOL);
		}
		$data['host'] = $hostname ? $hostname : ($_SERVER['HTTP_HOST'] ?? gethostname());
		$url = rtrim($this->url_base, '/') . '/acesso/';
		return $this->request($url, $data);
	}
	
	public function enviarMsgWhatsApp($phone, $message)
	{
		$data['phone']   	= $phone;
		$data['message'] 	= $message;
		$url = rtrim($this->url_base, '/') . '/wapi/sendmsg/';
		return $this->request($url, $data);
	}
	
	public function enviarMsgTelegram($chat_id, $message)
	{
		$data['chat_id']   	= $chat_id;
		$data['message'] 	= $message;
		$url = rtrim($this->url_base, '/') . '/tgm/sendmsg/';
		return $this->request($url, $data);
	}
	
	public function enviarEmail($email, $title, $message)
	{
		$data['email'] 	 	= $email;
		$data['title'] 		= $title;
		$data['message'] 	= $message;
		$url = rtrim($this->url_base, '/') . '/email/sendmail/';
		return $this->request($url, $data);
	}
	
	public function enviarEmailsBroadcast($dataset, $title, $template, $init = false)
	{
		$data['dataset']	 = $dataset; # [['email' => 'email', 'var' => 'var']]
		$data['title'] 		 = $title;
		$data['template_id'] = $template;
		$data['init'] 		 = $init; # Y-m-d H:i:s || false = immediate
		$url = rtrim($this->url_base, '/') . '/email/broadcast/';
		return $this->request($url, $data);
	}
	
	public function webhookWhatsApp($url)
	{
		$this->webhook('wapi_webhook', $url);
	}
	
	public function webhookTelegram($url)
	{
		$this->webhook('tgm_webhook', $url);
	}
	
	private function webhook($field,$value)
	{
		$data[$field] = $value;
		$url = rtrim($this->url_base, '/') . '/webhooks/';
		return $this->request($url, $data);
	}
	
	private function request($url, $data)
	{
		$curl = curl_init();
		
		$data['api_token'] = $this->api_token;
		
		$json = json_encode($data);

		$headers = [
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json)
		];

		curl_setopt_array($curl, [
			CURLOPT_URL             => $url,
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => '',
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => 'POST',
			CURLOPT_POSTFIELDS      => $json,
			CURLOPT_HTTPHEADER      => $headers
		]);

		$response = curl_exec($curl);

		$e = curl_error($curl);

		curl_close($curl);

		if ($e) {
			echo $e . PHP_EOL;
			return false;
		}

		return $response;
	}
}
