<?php

class Model_CustomerAddress_Resource extends Model_Core_Table_Resource	
{
	
	function __construct()
	{
		$this->setTableName('customer_address');
		$this->setPrimaryKey('address_id');
	}
}