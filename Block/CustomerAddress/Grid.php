<?php

/**
 * 
 */
class Block_CustomerAddress_Grid extends Block_Core_Templete
{
	 function __construct()
	{
		parent::__construct();
		$this->setTemplete('customer_address/grid.phtml');
	}

	public function getAddress()
	{
		$row = Ccc::getModel('customerAddress');
		$request = $this->getRequest();
			
			if (!$request->isGet()) {
				throw new Exception("Invalid request", 1);
			}
			$id = $request->getParam('customer_id');

		$address=$row->load($id,'customer_id');
		return $address;
	}
}