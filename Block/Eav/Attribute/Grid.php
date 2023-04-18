<?php

/**
 * 
 */
class Block_Eav_Attribute_Grid extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/grid.phtml');
	}

	public function getAttribute()
	{
		$row = Ccc::getModel('eav_attribute');
		$query = "SELECT * FROM `eav_attribute`";
		$attributes = $row->fetchAll($query);
		
		return $attributes;

	}
}