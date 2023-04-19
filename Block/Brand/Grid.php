<?php
/**
*
*/
class Block_Brand_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('brand/grid.phtml');
	}
	

	public function getCollection()
	{
		$row = Ccc::getModel("Brand");
		$query = "SELECT * FROM `brand`";
		$brands = $row->fetchAll($query);
		return $brands;
		
	}
}