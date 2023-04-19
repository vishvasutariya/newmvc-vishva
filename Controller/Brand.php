<?php

class Controller_Brand extends Controller_Core_Action
{
	protected $brands = null;
	protected $brandid = null;
	protected $brandrow = null;

	
	public function setbrand($brand)
	{
		$this->brands = $brand;
		return $this;
	}
	public function getbrand()
	{
		return $this->brands;
	}
	public function setbrandId($brandid)
	{
		$this->brandid= $brandid;
		return $this;
	}
	public function getbrandId($value='')
	{
		return $this->brandid;
	}
	public function setbrandRow($brandrow)
	{
			$this->brandrow=$brandrow;
			return $this;
	}
	public function getbrandRow()
	{
		if ($this->brandrow!=null)
		{
			return $this->brandrow;
		}
		$brandrow= new Model_Brand_Resource();
		$this->setbrandRow($brandrow);
		return $brandrow;
	}

	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Brand_Grid();
		$layout->getChild('content')->addChild('grid', $grid);
		$brands = $grid->getCollection();
		$layout->render();
	}

	public function addAction()
	{
				$layout = $this->getLayout();
				$brand = Ccc::getModel('brand');
				$add = $layout->createBlock('brand_Edit')->setData(['brand'=>$brand]);

				 $layout->getChild('content')->addChild('add', $add);

				$layout->render();
	}
	
	public function editAction()
	{
		try {
			$request = $this->getRequest();
			$id=$request->getParam('brand_id');
			if(!$id)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelbrand = Ccc::getModel('brand');
			$query = "SELECT * FROM `brand` WHERE `brand_id`= '$id'";
			$brand =$modelbrand->fetchRow($query);
			if(!$brand)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('brand_Edit');
			$edit->setData(['brand' => $brand]);
			$layout->getChild('content')->addChild('edit',$edit);

			$layout->render();
				
		}
		catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages('data not found',Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=brand");
		}
	}
		public function saveAction()
		{
			try {
				$brand = Ccc::getModel('brand');
					$request=$this->getRequest();
					if (!$request->isPost()){
				throw new Exception("Invalid Request", 1);
					}
					$brands = $request->getPost('brand');
					if (!$brands) {
						throw new Exception("Data not posted", 1);
					}
					$id = $request->getParam('brand_id');
					if(!$id){
						if(!$brand->load($id)){
							throw new Exception("Data not found.", 1);
						}
					}
					$data = $brand->setData($brands);
					if ($data->brand_id) {
						$data->update_at = date('Y-m-d h:i:sa');
					}
					else{
						$data->create_at = date('Y-m-d h:i:sa');
					}
					$data = $brand->save();
					$message = new Model_Core_Message();
					$message->addMessages("brand saved successfully.",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=brand");
				
			} catch (Exception $e) {
				$message = new Model_Core_Message();
				$message->addMessages("brand not saved.",Model_Core_Message::FAILURE);
				$this->redirect("index.php?a=grid&c=brand");
			}
		}
	
	public function deleteAction()
	{
		try {
			$brand = Ccc::getModel('brand');
				$request = $this->getRequest();
				if (!$request->isGet())
				{
					throw new Exception("Invalid request", 1);
				}
				$id = $request->getParam('brand_id');
				if (!$id)
				{
					throw new Exception("id not found", 1);
				}
				$brand->load($id);
				$brand->delete();
				$message = new Model_Core_Message();
				$message->addMessages("brand deleted successfully..",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=brand");
			}catch (Exception $e)
			{
				$message = new Model_Core_Message();
				$message->addMessages("row not delete",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=brand");
			}
	}
}
?>