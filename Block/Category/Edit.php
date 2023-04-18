<?php

/**
 * 
 */
class Block_Category_Edit extends Block_Core_Templete
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('category/edit.phtml');
	}

	
}