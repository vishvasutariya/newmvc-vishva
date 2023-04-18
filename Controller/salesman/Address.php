<?php

class Controller_Salesman_Address extends Controller_Core_Action
{
	protected $address = null;
	protected $modeladdress = null;

	public function setAddress($address)
	{
		 $this->address = $address;
		 return $this;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setModelAddress($modeladdress)
	{
		 $this->modeladdress = $modeladdress;
		 return $this;
	}
	public function getModelAddress()
	{
		if ($this->modeladdress!=null) 
		{
			 return $this->modeladdress;
		}
		$modeladdress = new Model_Salesman_Address();
		$this->setModelAddress($modeladdress);
		return $this->modeladdress;
	}

	public function gridAction()
	{
		try {
			$row = Ccc::getModel('SalesmanAddress_Row');
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("Invalid request", 1);
			}
			$id = $request->getParam('salesman_id');
			$query=" SELECT * FROM `{$row->getTable()->getTableName()}` WHERE
			`salesman_id` = '$id'";
		$address=$row->load($id,'salesman_id');
		if (!$address) {
			throw new Exception("Missing Address", 1);
		}
		$this->getView()->setTemplete('Salesman_address/grid.phtml')->setData(['address' =>$address]);
		$this->render();
		} catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages("Address not found",Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=salesman_address");
		}
	}

	public function editAction()
	{
			 $id=$this->getRequest()->getParam('salesman_id');
		$sql="SELECT * FROM `salesman_address` WHERE `salesman_id`='$id'";
		 $address=$this->getModelAddress()->fetchRow(null,$sql);
		 $this->setAddress($address);
		 $this->getTemplete('salesman_address/edit.phtml');

	}

	public function updateAction()
	{
		 $address = $this->getRequest()->getPost('vendorAdd');
		 $condition['salesman_id'] = $address['salesman_id'];
		 $this->getModelAddress()->update($address,$condition);

	}
	 
}
?>