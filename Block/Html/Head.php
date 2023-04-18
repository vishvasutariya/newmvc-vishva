<?php

/**
 * 
 */
class Block_Html_Head extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/head.phtml');
	}
}