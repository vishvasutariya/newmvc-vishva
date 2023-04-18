<?php
require_once 'Controller/Core/Action.php';
require_once 'Model/Product_media.php';
require_once 'Model/Core/Message.php';
require_once 'Model/Media/Row.php';

/**
 * 
 */
class Controller_Product_media extends Controller_Core_Action
{
	protected $productmedia = null;
	protected $mediarow = null;
	protected $mediaid = null;
	
	public function setProductMedia($productmedia)
	{
		$this->productmedia=$productmedia;
		return $this;
	}

	public function getProductMedia()
	{
			return $this->productmedia;
	}

	public function setMediaId($mediaid)
	{
		$this->mediaid = $mediaid;
		return $this;
	}

	public function getMediaId()
	{
			return $this->mediaid;
	}
	

	public function setMediaRow($mediarow)
	 {
	 	  
	 	 	  $this->mediarow=$mediarow;
	 	 	  return $this;
	 	 
	 }
	 public function getMediaRow()
	 {
	 	if ($this->mediarow!=null) 
	 	{
	 		return $this->mediarow;
	 	}
	 	$mediarow=new Model_Media_Row();
	 	$this->setMediaRow($mediarow);
	 	 return $mediarow;
	 }

	

	 public function gridAction()
	 {
	 	// try {
	 			$request = $this->getRequest();
	 			$row = Ccc::getModel('ProductMedia_Row');
	 			$query = "SELECT * FROM `{$row->getTable()->getTableName()}`";
	 			 $media=$row->fetchAll($query);
	 			 $product_id = $request->getParam('product_id');
	 			 if (!$media) {
	 			 	throw new Exception("Image not found..", 1);
	 			 }
	 	 		 $this->getView()->setTemplete('product_media/grid.phtml')->setData(['media'=>$media]);
	 	 		 $this->render();
	 	// 	} catch (Exception $e) {
	 	// 	$message = new Model_Core_Message();
	 	// 	$message->addMessages("Data Not Found",Model_Core_Message::FAILURE);
	   	// 	return $this->redirect("index.php?a=grid&c=product_media&product_id=$product_id");

	 	// }
	 }
	 public function addAction()
	 {
	 	 $this->getView()->setTemplete('product_media/add.phtml');
	 	 $this->render();

	 }
	 public function insertAction()
	 {
	 	try{
	 	$request = $this->getRequest();
	 	if (!$request) {
	 		throw new Exception("Invalis Request", 1);
	 	}
	 	$productid = $request->getParam('product_id');
	 	if (!$productid) {				
	 		throw new Exception("ProductId not Found", 1);
	 	}
		 $image1=$_FILES['image'];
		 $imagefilename = $image1['name'];
		 $file=$request->getPost('filename');
		 $image['image'] = $imagefilename;
		 $image['filename'] = $file;

		$this->getMediaRow()->setData($image);
		$data = $this->getMediaRow()->save();
		$id = $data->image_id;
		if (!$id) {
				throw new Exception("InsertId Not Found", 1);
		}
		 $filetemp=$image1['tmp_name'];
		 $fileseprate=explode('.', $imagefilename);
		 $fileextension=$fileseprate[1];
		 $name=$id.'.'.$fileextension;
	 	 $uploadimage='View/product_media/image/'.$name;
		  $imagename=[];
		  $imagename['image'] = $name;
     	 move_uploaded_file( $_FILES['image']['tmp_name'], $uploadimage);

		$data = $this->getMediaRow()->load($id)->addData('image',$name)->save();
	
		$mesaage = new Model_Core_Message();
	 		$mesaage->addMessages("image Inserted Successfully..", Model_Core_Message::SUCCESS);
	    return $this->redirect("index.php?a=grid&c=product&product_id=$productid");
		}catch (Exception $e) {
		$mesaage = new Model_Core_Message();
	 		$mesaage->addMessages("image not Insert..", Model_Core_Message::FAILURE);
	   		return $this->redirect("index.php?a=grid&c=product_media&product_id=$productid");
	}

	}
	public function updateAction()
	{
		try {echo "<pre>";
				$mediarow = Ccc::getModel("ProductMedia_Row");
			    $request= $this->getRequest();
			    if (!$request) {
			    	throw new Exception("Invalid Request", 1);
			    }
			    $productid = $request->getParam('product_id');
			    $id = $request->getPost('image_id');
			    // $thumb = $request->getPost('thumb');
			    // $base = $request->getPost('base');
			    // $small = $request->getPost('small');
    			// $gallery = $request->getPost('gallery');
			    
			    $images = $request->getPost();
			    $condition = ['image_id'=>$id];
			    $data = ['thumb'=>0,'base'=>0,'small'=>0,'gallery'=>0];
			    $result = $mediarow->addData('image_id',$condition)->save();
			    if (array_key_exists('thumb', $images)) {
			     // $data = ['thumb'=>1];
			    	$result = $mediarow->setData('thumb',1)->save();
			    }

			    if (array_key_exists('base', $images)) {
			     // $data = ['thumb'=>1];
			    	$result = $mediarow->setData('base',1)->save();
			    }

			     if (array_key_exists('small', $images)) {
			     // $data = ['thumb'=>1];
			    	$result = $mediarow->setData('small',1)->save();
			    }
			    	$data = ['gallery'=>1];

			    	foreach ($gallery as $key => $value) {
			    		$result = $mediarow->addData($data,$value)->save();
			    	}

	// return $this->redirect("index.php?a=grid&c=product_media&product_id=$productid");
	} catch (Exception $e) {
			$mesaage = new Model_Core_Message();
			$mesaage->addMessages("Image not Found..", Model_Core_Message::FAILURE);
	// return $this->redirect("index.php?a=grid&c=product_media&product_id=$productid");

		}
 }
  
	

 }
?>