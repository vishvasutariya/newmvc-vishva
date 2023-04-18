<?php

/**
 * 
 */
class Model_Eav_Resource_Attribute extends Model_Core_Table_Resource
{
	public $tableclass = "Model_Attribute";

	// function __construct()
	// {
	// 	parent::__construct();
	// 	// $this->setTableClass('Model_Admin');
	// }

public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Admin::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Admin::STATUS_DEFAULT];
	}
	

	
}