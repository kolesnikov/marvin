<?php

namespace MARVIN\EXCEPTIONS\CORE;

class WrongVariableName extends \Exception{
    
    public function __construct() {
        $message    = 'A call to a nonexistent class variable';
        parent::__construct($message);
    }
}
