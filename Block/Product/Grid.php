<?php
/**
*
*/
class Block_Product_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/grid.phtml');
	}
	

	public function getCollection()
	{
		$row = Ccc::getModel("Product");
		$query = "SELECT * FROM `product`";
		$products = $row->fetchAll($query);
		// print_r($products);
		return $products;
		
	}
}