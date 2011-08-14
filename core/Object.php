<?php
namespace MARVIN\CORE;

abstract class Object
{
    private $__updated;
	private $__source;

	function __construct() {
		$this->__source	= get_class_vars(get_class($this));
	}
	
    function __call($name, $arguments)
    {
		
        if (!in_array($name, array_keys($this->__source)))
			throw new \MARVIN\EXCEPTIONS\CORE\WrongVariableName ();
		
		if (count($arguments) == 0) return $this->$name;
		
		$this->__updated[$name]	= true;
		$this->$name	= $arguments[0];
	}
	
	function toArray()
	{
		$result	= array();
		foreach ($this->__source as $key=>$item){
			if (substr($key, 0, 2) !== '__') $result[$key]	= $this->$key();
		}
		return $result;
	}

}