<?php

/**
 * 
 */
class Block_Html_Header extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/header.phtml');
	}
}