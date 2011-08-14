<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace MARVIN\API\MAMBA;
/**
 * Description of Core
 *
 * @author nefrit
 */
class Core {
    static $loginPage		= 'http://mamba.ru/tips/?tip=login';
	static $userAnketa	= 'http://mamba.ru/%s/?afolder=dating';
    var $url;
    
    function __construct() {
        $this->url  = new \MARVIN\CORE\Http();
    }
    
    public function login($user, $password)
    {   
        $html   = $this->url->get(self::$loginPage);
        $page   = new \MARVIN\CORE\Nokogiri($html);
        
        $post   = array(
            's_post' => '',
            'tip' => '',
            'goto' => '',
            's' => '',
            'level' => '',
        );
        
        $form   = $page->get('form :input')->toArray();
        foreach ($form as $input)
        {
            if (@isset($post[ $input['name'] ]) && @isset($input['value']))
                $post[ $input['name'] ] = $input['value'];
        }
        
        $post['login']  = $user;
        $post['password']   = $password;
        
        $params = array(CURLOPT_REFERER => self::$loginPage);
        $result = $this->url->post('http://mamba.ru/tips/', $post, $params);
        
        if (preg_match("/Неверно указан логин или пароль/i", $result))
            throw new \MARVIN\EXCEPTIONS\API\MAMBA\LoginFail ();
    }
    
    public function getUser($username)
    {
        $link	= sprintf(self::$userAnketa, $username);
		$page	= $this->url->get($link);
		$user	= User::load($page);
		return $user;
    }
}

?>
