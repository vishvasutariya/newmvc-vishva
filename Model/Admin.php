<?php

/**
 * 
 */
class Model_Admin extends Model_Core_Table
{
	 function __construct()
	{
		$this->setResourceClass('Model_Admin_Resource');
	}
	// const STATUS_ACTIVE = 1;
	// const STATUS_ACTIVE_LBL ='Active';
	// const STATUS_INACTIVE = 2;
	// const STATUS_INACTIVE_LBL ='Inactive';
	// const STATUS_DEFAULT =2;

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Admin_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Admin_Resource::STATUS_DEFAULT];
	}

	 
}