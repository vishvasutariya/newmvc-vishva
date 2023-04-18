<?php

/**
 * 
 */
class Block_Html_Footer extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/footer.phtml');
	}
}