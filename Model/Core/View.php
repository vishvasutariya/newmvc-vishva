<?php

/**
 * 
 */
class Model_Core_View extends Controller_Core_Action
{
	
	public function __construct()
	{
		
	}
	
	protected $templete = null;
	protected $data = [];

	public function setTemplete($templete)
	{
		$this->templete = $templete;
		return $this;		
	}

	public function getTemplete()
	{
		return $this->templete;
	}

	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function render()
	{
		require "View".DS.$this->getTemplete();
	}

	public function getUrl($action = null, $controller = null, $params = [], $reset = false)
	{
		$url = Ccc::getModel('Core_Url')->getUrl($action, $controller, $params, $reset);
		return $url;
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		if (!array_key_exists($key, $this->data)) {
			return null;
		}
		return $this->data[$key];
	}

	
}