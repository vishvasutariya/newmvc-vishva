<?php

/**
 * 
 */
class Block_Admin_Edit extends Block_Core_Templete
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('admin/edit.phtml');
	}

	
}