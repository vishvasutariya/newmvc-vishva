<?php

/**
 * 
 */
class Model_Vendor_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		$this->setTableName('vendor');
		$this->setPrimaryKey('vendor_id');
	}
	
}