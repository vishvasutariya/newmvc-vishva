<?php

/**
 * 
 */
class Block_Product_Edit extends Block_Core_Templete
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('product/edit.phtml');
	}

	
}