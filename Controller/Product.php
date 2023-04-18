<?php

class Controller_product extends Controller_Core_Action
{
	protected $products = null;
	protected $productid = null;
	protected $productrow = null;

	
	public function setProduct($product)
	{
		$this->products = $product;
		return $this;
	}
	public function getProduct()
	{
		return $this->products;
	}
	public function setProductId($productid)
	{
		$this->productid= $productid;
		return $this;
	}
	public function getProductId($value='')
	{
		return $this->productid;
	}
	public function setProductRow($productrow)
	{
			$this->productrow=$productrow;
			return $this;
	}
	public function getProductRow()
	{
		if ($this->productrow!=null)
		{
			return $this->productrow;
		}
		$productrow= new Model_Product_Resource();
		$this->setProductRow($productrow);
		return $productrow;
	}

	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_product_Grid();
		$layout->getChild('content')->addChild('grid', $grid);
		$products = $grid->getCollection();
		$layout->render();
	}

	public function addAction()
	{
				$layout = $this->getLayout();
				$product = Ccc::getModel('product');
				$add = $layout->createBlock('Product_Edit')->setData(['product'=>$product]);

				 $layout->getChild('content')->addChild('add', $add);

				$layout->render();
	}
	
	public function editAction()
	{
		try {
			$request = $this->getRequest();
			$id=$request->getParam('product_id');
			if(!$id)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelProduct = Ccc::getModel('Product');
			$query = "SELECT * FROM `product` WHERE `product_id`= '$id'";
			$product =$modelProduct->fetchRow($query);
			if(!$product)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Product_Edit');
			$edit->setData(['product' => $product]);
			$layout->getChild('content')->addChild('edit',$edit);

			$layout->render();
				
		}
		catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages('data not found',Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=product");
		}
	}
		public function saveAction()
		{
			try {
				$product = Ccc::getModel('Product');
					$request=$this->getRequest();
					if (!$request->isPost()){
				throw new Exception("Invalid Request", 1);
					}
					$products = $request->getPost('product');
					if (!$products) {
						throw new Exception("Data not posted", 1);
					}
					$id = $request->getParam('product_id');
					if(!$id){
						if(!$product->load($id)){
							throw new Exception("Data not found.", 1);
						}
					}
					$data = $product->setData($products);
					if ($data->product_id) {
						$data->update_at = date('Y-m-d h:i:sa');
					}
					else{
						$data->create_at = date('Y-m-d h:i:sa');
					}
					$data = $product->save();
					$message = new Model_Core_Message();
					$message->addMessages("Product saved successfully.",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=product");
				
			} catch (Exception $e) {
				$message = new Model_Core_Message();
				$message->addMessages("Product not saved.",Model_Core_Message::FAILURE);
				$this->redirect("index.php?a=grid&c=product");
			}
		}
	
	public function deleteAction()
	{
		try {
			$product = Ccc::getModel('Product');
				$request = $this->getRequest();
				if (!$request->isGet())
				{
					throw new Exception("Invalid request", 1);
				}
				$id = $request->getParam('product_id');
				if (!$id)
				{
					throw new Exception("id not found", 1);
				}
				$product->load($id);
				$product->delete();
				$message = new Model_Core_Message();
				$message->addMessages("product deleted successfully..",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=product");
			}catch (Exception $e)
			{
				$message = new Model_Core_Message();
				$message->addMessages("row not delete",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=product");
			}
	}
}
?>