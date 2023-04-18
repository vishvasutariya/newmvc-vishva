<?php

/**
 * 
 */
class Model_Core_Table_Collection 
{
	protected $data = [];

	public function setData($data)
	{
		$this->data = array_merge($this->data, $data);
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function Count()
	{
		return count($this->data);
	}

	
}