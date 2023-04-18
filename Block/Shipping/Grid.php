<?php

/**
 * 
 */
class Block_Shipping_Grid extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('shipping/grid.phtml');
	}

	public function getCollection()
	{
		try {
			
		$query = "SELECT * FROM `shipping`";
		$shippings = Ccc::getModel('Shipping')->fetchAll($query);

		return $shippings;
		} catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages("Data not found",Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=shipping");
		}
	}
}