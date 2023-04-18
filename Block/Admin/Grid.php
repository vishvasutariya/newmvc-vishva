<?php

class Block_Admin_Grid extends Block_Core_Templete
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplete('admin/grid.phtml');
	}

	public function getCollection()
	{
		$row = Ccc::getModel("Admin");
		$query = "SELECT * FROM `admin`";
		$admins = $row->fetchAll($query);

		return $admins;
	}
}