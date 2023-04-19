<?php

class Model_Brand extends Model_Core_Table
{
	function __construct()
	{
		 $this->setResourceClass('Model_Brand_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Brand_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Brand_Resource::STATUS_DEFAULT];
	}

}

?>