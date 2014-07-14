<?php
	function getIP()
	{
		$realip;
		if (isset($_SERVER))
		{
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			{
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			else if (isset($_SERVER["HTTP_CLIENT_IP"]))
			{
				$realip = $_SERVER["HTTP_CLIENT_IP"];
			} 
			else
			{
				$realip = $_SERVER["REMOTE_ADDR"];
			}
		}
		else 
		{
			if (getenv("HTTP_X_FORWARDED_FOR"))
			{
				$realip = getenv("HTTP_X_FORWARDED_FOR");
			}
			else if (getenv("HTTP_CLIENT_IP"))
			{
				$realip = getenv("HTTP_CLIENT_IP");
			}
			else
			{
			 $realip = getenv("REMOTE_ADDR");
			}
		}
		return $realip;
	}

	function getCity($ip)
	{
		$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
		$ip=json_decode(file_get_contents($url)); 
		if((string)$ip->code=='1')
		{
			return false;
		}
		$data = (array)$ip->data;
		return $data; 
	}

	function RecoverRequest($content)
	{
		if(!get_magic_quotes_gpc())
			return stripslashes(htmlspecialchars_decode($content));
		else
			return htmlspecialchars_decode($content);
	}