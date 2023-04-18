<?php

/**
 * 
 */
class Block_Shipping_Edit extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('shipping/edit.phtml');
	}

	public function createChild()
	{
		$request=$this->getRequest();
		$row = Ccc::getModel("Shipping");
		if (!$request) {
			throw new Exception("Invalid Request", 1);
		}
		$id = $request->getParam('shipping_id');
		if (!$id) {
			 return $row;
		}
		$shipping=$row->load($id);
		return  $shipping;

	}
}