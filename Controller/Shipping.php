<?php
class Controller_Shipping extends Controller_Core_Action
{
	protected $shipping = null;
	protected $modelshipping = null;
	public function setShipping($shipping)
	{
		$this->shipping = $shipping;
		return $this;
	}
	public function getShipping()
	{
		return $this->shipping;
	}
	public function setModelShipping($modelshipping)
	{
		$this->modelshipping = $modelshipping;
	}
	public function getModelShipping()
	{
		if ($this->modelshipping!=null)
		{
			return $this->modelshipping;
		}
		$modelshipping = new Model_Shipping();
		$this->setModelShipping($modelshipping);
		return $modelshipping;
	}
	public function gridAction()
	{
		try {
				$layout = $this->getLayout();
				$grid = new Block_Shipping_Grid();
				$layout->getChild('content')->addChild('grid' , $grid);
				$layout->render();
		} catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages("Data not Display..",Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=shipping");
		}
	}
	public function addAction()
	{
		try {
			$layout = $this->getLayout();
				$shipping = Ccc::getModel('Shipping');
				$add = $layout->createBlock('Shipping_Edit')->setData(['shipping'=>$shipping]);
				$layout->getChild('content')->addChild('add', $add);
				$layout->render();
			
		} catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages("Data not Display..",Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=shipping");
			}
	}
	public function editAction()
	{
		try {
			$request = $this->getRequest();
			$id=$request->getParam('shipping_id');
			if(!$id)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$shipping = Ccc::getModel('Shipping');
			$query = "SELECT * FROM `shipping` WHERE `shipping_id`= '$id'";
			$shippings =$shipping->fetchRow($query);
			if(!$shippings)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Shipping_Edit');
			$edit->setData(['shipping' => $shipping]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();

		} catch (Exception $e) {
		$message = new Model_Core_Message();
		$message->addMessages("Data Not Display ..",Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=shipping");
		}
	}
	public function saveAction()
		{
			try {
				$shipping = Ccc::getModel('Shipping');
					$request=$this->getRequest();
					if (!$request->isPost()){
				throw new Exception("Invalid Request", 1);
					}
					$shippings = $request->getPost('shipping');
					if (!$shippings) {
						throw new Exception("Data not posted", 1);
					}
					$id = $request->getParam('shipping_id');
					if(!$id){
						if(!$shipping->load($id)){
							throw new Exception("Data not found.", 1);
						}
					}
					$data = $shipping->setData($shippings);
					if ($data->shipping_id) {
						$data->update_at = date('Y-m-d h:i:sa');
					}
					else{
						$data->create_at = date('Y-m-d h:i:sa');
					}
					$data = $shipping->save();
					$message = new Model_Core_Message();
					$message->addMessages("Data saved successfully.",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=shipping");
				
			} catch (Exception $e) {
				$message = new Model_Core_Message();
				$message->addMessages("Data not saved.",Model_Core_Message::FAILURE);
				$this->redirect("index.php?a=grid&c=shipping");
			}
		}
	public function deleteAction()
	{
		try {
		$row = Ccc::getModel('Shipping_Row');
		$request = $this->getRequest();
		if (!$request) {
			throw new Exception("Invalid Request", 1);
		}
		$id = $request->getParam('shipping_id');
		if (!$id) {
			throw new Exception("id not found", 1);
		}
		$row->load($id);
		$row->delete();
		$message = new Model_Core_Message();
		$message->addMessages("Row Delete Successfully..",Model_Core_Message::SUCCESS);
		$this->redirect("index.php?a=grid&c=shipping");
		} catch (Exception $e) {
		$message = new Model_Core_Message();
		$message->addMessages("Data Not Delete ..",Model_Core_Message::FAILURE);
		$this->redirect("index.php?a=grid&c=shipping");
		}
	}
}
?>