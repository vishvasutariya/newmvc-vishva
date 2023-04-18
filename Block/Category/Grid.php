<?php

/**
 * 
 */
class Block_Category_Grid extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('category/grid.phtml');
	}

	public function getCollection()
	{
		$row = Ccc::getModel("Category");
		$query = "SELECT * FROM `category`";
		$admins = $row->fetchAll($query);

		return $admins;
	}
}