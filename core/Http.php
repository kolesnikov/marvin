<?php
    
namespace MARVIN\CORE;

class Http
{
	private $__request;
	
	function __construct()
	{
		$curl	= curl_init();
		$this->__request	= $curl;
	}
	
	function get($url, $options = false)
	{
		return $this->request($url, $options);
	}
	
	function post($url, $data, $options	= false)
	{
		$localOptions	= array(
			CURLOPT_POST 		=> true,
			CURLOPT_POSTFIELDS 	=> $data
		);
		
        if (is_array($options))
            foreach ($options as $key=>$value) $localOptions[$key]   = $value;
        
		return $this->request($url, $localOptions);
	}
	
	private function request($url, $options = false)
	{
		$curl	= $this->__request;
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
		
		if (is_array($options))
		{
			foreach($options as $key => $value)
			{
				curl_setopt($curl, $key, $value);
			}
		}

		return curl_exec($curl);
	}
}

?>