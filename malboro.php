<?php

/**
 * Thanks To : Janu Yoga & Aan Ahmad
 * Date Share : 27-03-2019
 * Date Updated V.3 : 30-MEI-2019
 * Created By : Will Pratama - facebook.com/yaelahhwil
**/

date_default_timezone_set("Asia/Jakarta");
class Marlboro extends modules
{
	protected $cookie;
	protected $modules;

	public function __construct()
	{
		$this->modules = new modules();
	}

	private function cookiesAkun()
	{
		$file = "cookiesAkun.txt";
		foreach(explode("\n", str_replace("\r", "", file_get_contents($file))) as $a => $data)
		{
			return array("cookie" => @explode("|", trim($data))[0], "email" => @explode("|", trim($data))[1], "password" => @explode("|", trim($data))[2], "deviceid" => @explode("|", trim($data))[3]);
		}
	}

	private function login($email, $password)
	{
		if(@file_exists("cookiesAkun.txt") == true){@unlink("cookiesAkun.txt");}if(@file_exists("cookiesMarlboro.txt") == true){@unlink("cookiesMarlboro.txt");}

		$cook = $this->modules->fetchCookies($this->modules->curl("https://www.marlboro.id", null, false, false, true, array("Host: www.marlboro.id"), 'GET'));
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
		$headers[] = "Cookie: decide_session=".$cook['decide_session'];
		$headers[] = "Host: www.marlboro.id";
		$headers[] = "Origin: https://www.marlboro.id";
		$headers[] = "Referer: https://www.marlboro.id/";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW".rand(000, 999).") AppleWebKit/".rand(00000, 99999).".36 (KHTML, like Gecko) Chrome/72.0.".rand(00000, 99999).".".rand(00000, 99999)." Safari/".rand(00000, 99999).".36";
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$csrf = $this->modules->getStr($this->modules->curl("https://www.marlboro.id", null, false, false, false, $headers, 'GET'), 'name="decide_csrf" value="', '"', 1, 0);
		$login = $this->modules->curl("https://www.marlboro.id/auth/login", "email=".$email."&password=".$password."&decide_csrf=".$csrf."&ref_uri=/", true, false, true, $headers);
	   	$cookies = $this->modules->fetchCookies($login)['decide_session'];
		$deviceid = $this->modules->fetchCookies($login)['deviceId'];
	    $this->modules->fwrite("cookiesAkun.txt", @$cookies."|".$email."|".$password."|".$deviceid);
		return $login;
	}

	private function idVidio()
	{
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
		$headers[] = "Cookie: deviceId=".$this->cookiesAkun()['deviceid']."; decide_session=".$this->cookiesAkun()['cookie'];
		$headers[] = "Host: www.marlboro.id";
		$listIdVidio = $this->modules->curl("https://www.marlboro.id", null, false, true, false, $headers, 'GET');
		return $listIdVidio;
	}

	protected function view($idVidio)
	{
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
		$headers[] = "Cookie: deviceId=".$this->cookiesAkun()['deviceid']."; _ga=GA1.2.80096599.1559215776; _gid=GA1.2.79762902.1559215776; ins-mig-done=1; ev=1; _mm3rm4bre_=6B%2FUJWvPEfAWe0iZqDpXOJ1YF8gkcXhrMXVyJC5tajloaHdpamgwem1uYnhrdmlldjQ%3D; accC=true; mp_41fb5b1708a7763a1be4054da0f74d65_mixpanel=%7B%22distinct_id%22%3A%20%2216b0880a02b18f-066b2c15aa7e45-e353165-100200-16b0880a02c862%22%2C%22%24device_id%22%3A%20%2216b0880a02b18f-066b2c15aa7e45-e353165-100200-16b0880a02c862%22%2C%22%24initial_referrer%22%3A%20%22%24direct%22%2C%22%24initial_referring_domain%22%3A%20%22%24direct%22%7D; content_viewc=3; token=JeLy0F7pzJK722MQXeXVcxqbZSdTNxOX; refresh_token=0nvFDJuHhlQ7gb5x21X5GUfzdpnM2vPz; _gat_UA-102334128-3=1; decide_session=".$this->cookiesAkun()['cookie'];
		$headers[] = "Host: www.marlboro.id";
		$headers[] = "Origin: https://www.marlboro.id";
		$headers[] = "Referer: https://www.marlboro.id/";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW".rand(000, 999).") AppleWebKit/".rand(00000, 99999).".36 (KHTML, like Gecko) Chrome/72.0.".rand(00000, 99999).".".rand(00000, 99999)." Safari/".rand(00000, 99999).".36";
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$csrf = $this->modules->getStr($this->modules->curl("https://www.marlboro.id/", null, false, true, false, $headers, 'GET'), 'name="decide_csrf" value="', '"', 1, 0);
		$view = $this->modules->curl("https://www.marlboro.id/article/video-play/".$idVidio, "decide_csrf=".$csrf."&log_id=false&duration=0.009&total_duration=0&fetch=1&g-recaptcha-response=", false, false, true, $headers);
		return $view;
	}

	protected function update($idVidio, $decide_session, $log_id)
	{
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
		$headers[] = "Cookie: deviceId=".$this->cookiesAkun()['deviceid']."; _ga=GA1.2.80096599.1559215776; _gid=GA1.2.79762902.1559215776; ins-mig-done=1; ev=1; _mm3rm4bre_=6B%2FUJWvPEfAWe0iZqDpXOJ1YF8gkcXhrMXVyJC5tajloaHdpamgwem1uYnhrdmlldjQ%3D; accC=true; mp_41fb5b1708a7763a1be4054da0f74d65_mixpanel=%7B%22distinct_id%22%3A%20%2216b0880a02b18f-066b2c15aa7e45-e353165-100200-16b0880a02c862%22%2C%22%24device_id%22%3A%20%2216b0880a02b18f-066b2c15aa7e45-e353165-100200-16b0880a02c862%22%2C%22%24initial_referrer%22%3A%20%22%24direct%22%2C%22%24initial_referring_domain%22%3A%20%22%24direct%22%7D; content_viewc=3; token=JeLy0F7pzJK722MQXeXVcxqbZSdTNxOX; refresh_token=0nvFDJuHhlQ7gb5x21X5GUfzdpnM2vPz; _gat_UA-102334128-3=1; decide_session=".$this->cookiesAkun()['cookie'];
		$headers[] = "Host: www.marlboro.id";
		$headers[] = "Origin: https://www.marlboro.id";
		$headers[] = "Referer: https://www.marlboro.id/";
		$headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW".rand(000, 999).") AppleWebKit/".rand(00000, 99999).".36 (KHTML, like Gecko) Chrome/72.0.".rand(00000, 99999).".".rand(00000, 99999)." Safari/".rand(00000, 99999).".36";
		$headers[] = "X-Requested-With: XMLHttpRequest";
		$csrf = $this->modules->getStr($this->modules->curl("https://www.marlboro.id/", null, false, true, false, $headers, 'GET'), 'name="decide_csrf" value="', '"', 1, 0);
		$update = $this->modules->curl("https://www.marlboro.id/article/video-play/".$idVidio, "decide_csrf=".$csrf."&log_id=".$log_id."&duration=11.113&total_duration=5&fetch=2&g-recaptcha-response=", false, true, false, $headers);
		return $update;
	}

	private function getPoint()
	{
		$headers = array();
		$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
		$headers[] = "Cookie: "."deviceId=".$this->cookiesAkun()['deviceid']."; decide_session=".$this->cookiesAkun()['cookie'];
		$headers[] = "Host: www.marlboro.id";
		$get = $this->modules->curl("https://www.marlboro.id/profile", null, false, true, false, $headers, 'GET');
		return @$this->modules->getStr($get, '<div class="point">', '</div>', 1, 0);
	}

	public function execute_login($email, $password)
	{
		for($o=1;$o<=10;$o++)
		{
			@$saldo_awal = $this->getPoint();
			$login = $this->login($email, $password);
			@$cookies = $this->modules->fetchCookies($login)['decide_session'];
			@$deviceid = $this->modules->fetchCookies($login)['deviceId'];
			if(strpos($login, '"code":200,"message":"success"'))
			{
				$this->modules->fwrite("cookiesAkun.txt", @$cookies."|".$email."|".$password."|".$deviceid.PHP_EOL);
				if(@$this->getPoint() == $saldo_awal)
				{
					print PHP_EOL."Limit Get Point Login...";
					return false;
				}else{
					print PHP_EOL."Success Login!, Point Anda : ".$this->getPoint()." Pts";
				}
			}elseif(strpos($login, '"message":"Please Accept GoAheadPeople T&C"')){
				print PHP_EOL."Failed Login!, Message : Please Accept GoAheadPeople T&C.. Retry!";
			}else{
				if(@file_exists("cookiesAkun.txt") == true){@unlink("cookiesAkun.txt");}if(@file_exists("cookiesMarlboro.txt") == true){@unlink("cookiesMarlboro.txt");}
				print PHP_EOL."Failed Login";
				return false;
			}
		}
	}

	public function execute_nonton($email)
	{
		print PHP_EOL."Go Bot Nonton..";
		if(@file_exists("cookiesAkun.txt") == false){return "continue..";}if(@file_exists("cookiesMarlboro.txt") == false){return "continue..";}
		$ya = 1;
		for($b = $ya; $b <= ($ya + 20); $b++)
		{	
			if($b%2 == 1)
			{
				@$saldo_awal = $this->getPoint();
				$idVidio = $this->modules->getStr($this->idVidio(), 'data-ref="https://www.marlboro.id/discovered/article/', '"', $b, 0);
				if(!empty($idVidio))
				{
					$view = $this->view($idVidio);
					$decide_session = $this->modules->fetchCookies($view)['decide_session'];
					$log_id = $this->getStr($view, '"log_id":"', '"', 1, 0);
					if(strpos($view, '"message":"Success to store log play video."'))
					{
						print PHP_EOL."Sedang Menonton : ".$idVidio;
						//sleep(20);
						$update = $this->update($idVidio, $decide_session, $log_id);
						if(strpos($update, '"finished":true'))
						{
							if(@$this->getPoint() == @$saldo_awal)
							{
								print PHP_EOL."Limit Get Point Nonton!,  Done : ".$email." | ".$this->getPoint()." Pts";
								return false;
							}else{	
								print PHP_EOL."Success Menonton!, Point anda : ".$this->getPoint()." Pts";
							}	
						}else{
							print PHP_EOL."Failed!, Point Anda : ".$this->getPoint().PHP_EOL.$update;
						}
					}elseif(strpos($view, '"message":"Action is not allowed"')){
						print PHP_EOL."Failed Menonton Vidio!, Message : Action is not allowed..";
						return false;
					}else{
						print PHP_EOL."Response View : ".$view.PHP_EOL;
					}	
				}else{
					print PHP_EOL."ID Vidio Tidak Ditemukan..";
					return false;
				}
			}
		}	
	}
}

class modules 
{
	public function curl($url, $params, $cookie, $cookiefile, $header, $httpheaders, $request = 'POST', $socks = "")
	{
		$cookies = "cookiesMarlboro.txt";
		$this->ch = curl_init();
			
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);

		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $request);

		if($cookie == true)
		{	
			curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookies);
		}

		if($cookiefile == true)
		{
			curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookies);
		}

		curl_setopt($this->ch, CURLOPT_HEADER, $header);
		@curl_setopt($this->ch, CURLOPT_HTTPHEADER, $httpheaders);

		curl_setopt($this->ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		curl_setopt($this->ch, CURLOPT_PROXY, $socks);
		curl_setopt($this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);

		curl_setopt($this->ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		$response = curl_exec($this->ch);
		return $response;
		curl_close($this->ch);
	}

	public function getStr($page, $str1, $str2, $line_str2, $line)
	{
		$get = explode($str1, $page);
		$get2 = explode($str2, $get[$line_str2]);
		return $get2[$line];
	}

	public function fetchCookies($source) 
	{
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $source, $matches);
		$cookies = array();
		foreach($matches[1] as $item) 
		{
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}

		return $cookies;
	}

	public function fwrite($namafile, $data)
	{
		$fh = fopen($namafile, "a");
		fwrite($fh, $data);
		fclose($fh);  
	}
}	

$modules = new modules();
$marlboro = new marlboro();

//print $marlboro->login("kaowkawok@gmail.com", "npwilgans@");
//print $marlboro->view("how-to-rock-suit-with-sneakers");

awal:
echo "Input FIle Akun Marlboro (Email|Pass) : ";
$fileakun = trim(fgets(STDIN));

if(empty(@file_get_contents($fileakun)))
{
	print PHP_EOL."File Akun Tidak Ditemukan.. Silahkan Input Ulang".PHP_EOL;
	goto awal;
}

print PHP_EOL."Total Ada : ".count(explode(PHP_EOL, @file_get_contents($fileakun)))." Akun ".PHP_EOL."Letsgo..";

while(true)
{
	$time = date("Y-m-d H:i:s");
	echo PHP_EOL."Start Date : ".$time;
	foreach(@explode("\n", str_replace("\r", "", @file_get_contents($fileakun))) as $c => $akon)
	{	
		$date = date("Y-m-d H:i:s");
		$email = explode("|", trim($akon))[0];
		$password = explode("|", trim($akon))[1];
		echo PHP_EOL.PHP_EOL."Ekse Akun : ".$email.PHP_EOL;
		$marlboro->execute_login($email, $password);
		$marlboro->execute_nonton($email);
	}
	
	echo PHP_EOL.PHP_EOL."Sleep Time : ".$date;
	print PHP_EOL."All Done Run!, Sleep 24 Hours";
	print PHP_EOL."Start Besok : ".date('Y-m-d H:i:s', time() + (60 * 60 * 24));
	sleep(86400);
}

?>