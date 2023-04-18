<?php

class Block_Eav_Attribute_Edit extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('eav/attribute/edit.phtml');
	}

	public function getentities()
	{
		$entityTypeModel = Ccc::getModel('entity_type');
		$sql = "SELECT * FROM `entity_type`";
		$collection = $entityTypeModel->fetchAll($sql);
		return $collection;
	}
	public function getOptions()
	{
		$request = $this->getRequest();
		$id = (int)$request->getParam('attribute_id');
		$options = Ccc::getModel('Eav_Attribute_Option');

		if ($id)
		{
			$sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$id}";
			$options = $options->fetchAll($sql);
		}
		return  $options; 
	}
}