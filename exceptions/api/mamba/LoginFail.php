<?php
namespace MARVIN\EXCEPTIONS\API\MAMBA;

class LoginFail extends \Exception{
    
    public function __construct() {
        $message    = 'Неверный логин или пароль';
        parent::__construct($message);
    }
}
