<?php

/**
 * 
 */
class Block_Vendor_Edit extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('vendor/edit.phtml');
	}

	public function createChild()
	{
		
	}
}