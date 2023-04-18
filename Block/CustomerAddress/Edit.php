<?php

/**
 * 
 */
class Block_CustomerAddress_Edit extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function createChild()
	{
		$address = Ccc::getModel('CustomerAddress');
			$request=$this->getRequest();
			if (!$request) {
				throw new Exception("Invalid Request..", 1);
				}
			$id = $request->getParam('customer_id');
		$query="SELECT * FROM `customer_address` WHERE `customer_id`='$id'";
		$address=$address->fetchAll($query);
		return $address;
	}
}