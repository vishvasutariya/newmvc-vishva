<?php

/**
 * 
 */
class Block_Html_Content extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('html\content.phtml');
	}
}