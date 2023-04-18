<?php

/**
 * 
 */
class Block_Html_Message extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('html/message.phtml');
	}
}