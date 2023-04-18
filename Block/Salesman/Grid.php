<?php

/**
 * 
 */
class Block_Salesman_Grid extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('salesman/grid.phtml');
	}

	public function getCollection()
	{
		$row = Ccc::getModel('Salesman');
		$query = "SELECT * FROM `salesman`";
		$salesmen = $row->fetchAll($query);
		return $salesmen;
	}
}