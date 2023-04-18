<?php

class Controller_Salesman extends Controller_Core_Action
{
	protected $salesman = null;
	protected $salesmanid = null;
	protected $modelsalesman = null;
	protected $modeladdress = null;

	public function setSalesman($salesman)
	{
		$this->salesman =$salesman;
		return $this;
	}

	public function getSalesman()
	{
		return $this->salesman;
	}

	public function setModelSalesman($modelsalesman)
	{
		$this->modelsalesman = $modelsalesman;
		return $this;
	}

	public function getModelSalesman()
	{
		if ($this->modelsalesman!=null) 
		{
			return $this->modelsalesman = $modelsalesman;
		}
		$modelsalesman = new Model_Salesman();
		$this->setModelSalesman($modelsalesman);
		return $modelsalesman;
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
			$layout = $this->getLayout();
			$grid = new Block_Salesman_Grid();
			$layout->getChild('content')->addChild('grid', $grid);
			$layout->render();
		 } catch (Exception $e) {
			$message  = new Model_Core_Message();
			$message->addmessages("Data Not Found..",Model_Core_Message::FAILURE);
	 	    $this->redirect("index.php?a=grid&c=salesman");
		}
	}

	public function addAction()
	{
		$salesman = Ccc::getModel('Salesman_Row');
		$address = Ccc::getModel('SalesmanAddress_Row');
		if (!$salesman) {
			throw new Exception("Data not found", 1);
		}
		 $this->getView()->setTemplete("salesman/edit.phtml")->setData(['salesman'=>$salesman,'address'=>$address]);
		 $this->render();
	}

	public function editAction()
	{
		try {
			$Row = Ccc::getModel("Salesman_Row");
			$address = Ccc::getModel("SalesmanAddress_Row");
		$request=$this->getRequest();
		if (!$request) {
			throw new Exception("Invalid Request", 1);
		}
		$id = $request->getParam('salesman_id');
		$query = "SELECT * FROM `salesman_address` WHERE `salesman_id` = '$id'";
		$address = Ccc::getModel('SalesmanAddress_Row')->fetchRow($query);
		if (!$id) {
			throw new Exception("Id not found", 1);
		}
		$salesman=$Row->load($id);
		 $this->getView()->setTemplete("salesman/edit.phtml")->setData(['salesman'=>$salesman,'address'=>$address]);
		 $this->render();
		} catch (Exception $e) {
			$message  = new Model_Core_Message();
			$message->addmessages("Data Not Found..",Model_Core_Message::FAILURE);
	 	    $this->redirect("index.php?a=grid&c=salesman");
		}
	}

	public function saveAction()
	{
		try 
		{
			$request=$this->getRequest();
			$modelSalesman = Ccc::getModel('Salesman_Row');
			$modelSalesmanAddress = Ccc::getModel('SalesmanAddress_Row');
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$salesman = $request->getPost('salesman');
			$salesmanAddress = $request->getPost('salesmanAdd');


			$id = $request->getParam('salesman_id');
			
			if($id){
				$salesmanRow = $modelSalesman->load($id);

				if(!$salesmanRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$salesmanAddress['salesman_id'] = $id;
				$salesman['salesman_id'] = $id;
			$salesman['update_at']  = date('Y-m-d h:i:sa');
				
			}
			$insertSalesman = $modelSalesman->setData($salesman)->save();
			if (!$id) {
			$salesmanAddress['salesman_id'] = $insertSalesman->salesman_id;
			}


			if ($id) {
				
			$query = "SELECT * FROM `salesman_address` WHERE `salesman_id` = '$id'";
				$salesmanAddressRow = $modelSalesmanAddress->fetchRow($query);
			$salesmanAddress['address_id'] = $salesmanAddressRow->address_id;

			}

			$insertsalesmanAddress = $modelSalesmanAddress->setData($salesmanAddress)->save();
			
	  	    $message = new Model_Core_Message();
	  	     $message->addMessages("Data saved Successfully..",Model_Core_Message::SUCCESS);
	 		$this->redirect("index.php?a=grid&c=salesman");
		}
		catch (Exception $e)
		{
			$message = new Model_Core_Message();
	  	     $message->addMessages($e->getMessage(),Model_Core_Message::FAILURE);
	 		$this->redirect("index.php?a=grid&c=salesman");
		}
	}
	public function deleteAction()
	{
		try {
		 $Row = Ccc::getModel("Salesman_Row");
		 $request=$this->getRequest();
		 if (!$request) {
		 	throw new Exception("Invalid Request", 1);
		 }
		 $id = $request->getParam('salesman_id');
		 if (!$id) {
		 	throw new Exception("Id not found", 1);
		 }
		 $Row->load($id);
		 $Row->delete();
		 $message = new Model_Core_Message();
		 $message->addmessages("Row Deleted Successfully...",Model_Core_Message::SUCCESS);
	 	 $this->redirect("index.php?a=grid&c=salesman");
		} catch (Exception $e) {
		 $message = new Model_Core_Message();
		 $message->addmessages("Row Not Deleted...",Model_Core_Message::FAILURE);
	 	 $this->redirect("index.php?a=grid&c=salesman");
		}
	}
}
?>