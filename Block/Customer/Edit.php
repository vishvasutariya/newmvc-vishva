<?php

/**
 *
 */
class Block_Customer_Edit extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer/edit.phtml');
	}

	public function createChild()
	{
		$row = Ccc::getModel('customer');
	 	$request=$this->getRequest();
	 	if (!$request) {
	 		throw new Exception("Invalid Request", 1);
	 	}
	 	$id = $request->getParam('customer_id');
	 	// if (!$id) {
	 	// 	print_r($row);
	 	// 	return $row;
	 	// }
	 	$payment=$row->load($id);
	 	return $payment;
	}
}