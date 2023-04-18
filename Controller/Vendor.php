<?php

class Controller_Vendor extends Controller_Core_Action
{
	protected $vendor=null;
	protected $vendorid=null;
	protected $modelvendor=null;
	protected $modeladdress=null;

	
	public function setVendor($vendor)
	{
		$this->vendor=$vendor;
		return $this;
	}
	public function getVendor()
	{
		return $this->vendor;
	}
	public function setVendorid($vendorid)
	{
		$this->vendorid = $vendorid;
		return $this;
	}
	public function getVendorid()
	{
		return $this->vendorid;
	}
	public function setModelVendor($modelvendor)
	{
		$this->modelvendor = $modelvendor;
		return $this;
	}
	public function getModelVendor()
	{
		if ($this->modelvendor!=null)
		{
			return $this->modelvendor;
		}
		$modelvendor=new Model_Vendor();
		$this->setModelVendor($modelvendor);
		return $modelvendor;
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
		$modeladdress = new Model_Vendor_Address();
		print_r($modeladdress);
		$this->setModelAddress($modeladdress);
		return $this->modeladdress;
	}
	// public function gridAction()
	// {
		
	// }

	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = new Block_Vendor_Grid();
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
		} catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages("Data Not Found",Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=vendor");
		}
	}
	public function addAction()
	{
		$vendorRow = Ccc::getModel('Vendor_Row');
		$vendorAddress = Ccc::getModel('VendorAddress_Row');
		if (!$vendorRow) {
			throw new Exception("Vender not found", 1);
			
		}
		$this->getView()->setTemplete('vendor/edit.phtml')->setData(['vendor'=>$vendorRow,'address'=>$vendorAddress]);
		$this->render();
	}
	public function insertAction()
	{
		try {
			
		$request=$this->getRequest();
		if (!$request) {
			throw new Exception("Invalid Request", 1);
		}
		$vendor = $request->getPost('vendor');
		if (!$vendor) {
			throw new Exception("Data Not Posted", 1);
		}
		$vid = $this->getModelVendor()->insert($vendor);
		if (!$vid) {
			throw new Exception("InsertId Not Found", 1);
		}
		$data=$this->getRequest()->getPost('vendor_address');
		$data['vendor_id']=$vid;
		if (!$data) {
			throw new Exception("Address Data Not Posted", 1);
		}
		$this->getModelAddress()->insert($data);
		$message = new Model_Core_Message();
		$message->addMessages("Data Inserted Successfully..",Model_Core_Message::SUCCESS);
		$this->redirect("index.php?a=grid&c=vendor");
		} catch (Exception $e) {
		$message = new Model_Core_Message();
		$message->addMessages("Data Not Inserted ..",Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=vendor");
		}
	}
	public function editAction()
	{
		$vendors = Ccc::getModel('Vendor_Row');
		try {
				$request=$this->getRequest();
		if (!$request->isGet()){
		throw new Exception("Invali Request", 1);
		}
		$id = $request->getParam('vendor_id');
		if (!$id) {
		throw new Exception("Id Not Found", 1);
		}
		$query = "SELECT * FROM `vendor_address` WHERE `vendor_id` = '$id'";
		$address = Ccc::getModel('VendorAddress_Row')->fetchRow($query);

		$customer=$vendors->load($id);
		if (!$customer) {
		throw new Exception("Data not posted ", 1);
		}
		$this->getView()->setTemplete("vendor/edit.phtml")->setData(['vendors' =>$vendors,'address'=>$address]);
		$this->render();
		
		} catch (Exception $e) {
		$message = new Model_Core_Message();
		$message->addMessages("Data not found", Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=vendor");
		}
	}

	public function saveAction()
	{
		try 
		{
			$request=$this->getRequest();
			$modelVendor = Ccc::getModel('Vendor_Row');
			$modelVendorAddress = Ccc::getModel('VendorAddress_Row');
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$vendor = $request->getPost('vendor');
			$vendorAddress = $request->getPost('vendorAdd');


			$id = $request->getParam('vendor_id');
			
			if($id){
				$vendorRow = $modelVendor->load($id);

				if(!$vendorRow)
				{
					throw new Exception("invalid id.", 1);
				}
				$vendorAddress['vendor_id'] = $id;
				$vendor['vendor_id'] = $id;
			$vendor['update_at']  = date('Y-m-d h:i:sa');
				
			}
			$insertVendor = $modelVendor->setData($vendor)->save();
			if (!$id) {
			$vendorAddress['vendor_id'] = $insertVendor->vendor_id;
			}


			if ($id) {
				
			$query = "SELECT * FROM `vendor_address` WHERE `vendor_id` = '$id'";
				$vendorAddressRow = $modelVendorAddress->fetchRow($query);
			$vendorAddress['address_id'] = $vendorAddressRow->address_id;


			}

			$insertVendorAddress = $modelVendorAddress->setData($vendorAddress)->save();
			
	  	    $message = new Model_Core_Message();
	  	     $message->addMessages("Data saved Successfully..",Model_Core_Message::SUCCESS);
	 		$this->redirect("index.php?a=grid&c=vendor");
		}
		catch (Exception $e)
		{
			$message = new Model_Core_Message();
	  	     $message->addMessages($e->getMessage(),Model_Core_Message::FAILURE);
	 		$this->redirect("index.php?a=grid&c=vendor");
		}
	}
	
	public function deleteAction()
	{
		try {
			
		$request = $this->getRequest();
		if (!$request) {
			throw new Exception("Invalid Request", 1);
		}
		$id = $request->getParam('vendor_id');
		if (!$id) {
			throw new Exception("Invalid Id", 1);
		}
		$this->getModelVendor()->delete($id);
		$message = new Model_Core_Message();
		$message->addMessages("Row Delete Successfully..",Model_Core_Message::SUCCESS);
		$this->redirect("index.php?a=grid&c=vendor");
		} catch (Exception $e) {
		$message = new Model_Core_Message();
		$message->addMessages("Data Not Deletes ..",Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=vendor");
		}
	}
	
}
?>