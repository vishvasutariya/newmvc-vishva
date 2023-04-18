<?php

/**
 * 
 */
class Block_Vendor_Grid extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/grid.phtml');
	}

	public function getCollection()
	{
		$row = Ccc::getModel('vendor');
		$query = "SELECT * FROM `vendor`";
		$vendors = $row->fetchAll($query);
		return $vendors;
	}
}