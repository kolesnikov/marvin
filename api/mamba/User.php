<?php
namespace MARVIN\API\MAMBA;

//$values = array(
//    DAITING => array(
//        DAITING_MEET,
//        DAITING_LOOKING_FOR,
//        DAITING_PREFERRED_AGE,
//        DAITING_HOW_DO_I_GET_ACQUAINTED,
//        DAITING_PURPOSE,
//        DAITING_MARRIED,
//        DAITING_MATERIAL_SUPPORT,
//        DAITING_HAVE_CHILDREN
//    )
//);

class User extends \MARVIN\CORE\Object{
    public $username;
    public $adress;
    public $sex;
    public $age;
    public $zodiac;
    public $replyRate;
	public $link;
    
    static function load($html)
    {
		$user	= new \MARVIN\API\MAMBA\User();
		$page	= new \MARVIN\CORE\Nokogiri($html);	
		
		$dump	=	$page->get('h1.username a')->toArray();
		$user->link($dump['href']);
		$user->username($dump['#text']);
		
		$dump	= $page->get('address')->toArray();
		$user->adress($dump['#text']);
		
		$dump	= $page->get('div.age')->toArray();
		$user->age((int)$dump['span'][0]['#text']);
		$user->zodiac(trim($dump['#text'][1]));
		
		$dump	= $page->get('span.ProgressBar')->toArray();
		$user->replyRate((int)substr($dump['i'][0]['style'], 6));
		
		return $user;
    }
}

?>
