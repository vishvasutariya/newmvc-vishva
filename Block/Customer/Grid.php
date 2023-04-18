<?php

/**
 * 
 */
class Block_Customer_Grid extends Block_Core_Templete
{
	 function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/grid.phtml');
	}

	public function getCollection()
	{
		$row = Ccc::getModel('Customer');
		$query = "SELECT * FROM `customer`";
		$customers = $row->fetchAll($query);
		return $customers;
	}
}